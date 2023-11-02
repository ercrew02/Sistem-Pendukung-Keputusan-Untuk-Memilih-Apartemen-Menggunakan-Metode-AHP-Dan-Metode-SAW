<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Rel_kriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class Rel_kriteriaController extends Controller
{
    /**
     * Menampilkan semua data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data['title']='Data Nilai Kriteria';
        //Mengambil semua data kriteria dari tabel dan menyimpannya dalam array $data['kriteria_data']
        $data['kriteria_data'] = Kriteria::all();
        //Mengambil semua data relasi antar kriteria dari tabel tb_rel_kriteria, 
        //data relasi ini disimpan dalam array $data['rows'].
        $data['rows'] = DB::table('tb_rel_kriteria')
        //data diurutkan berdasarkan kolom ID1 dan ID2 secara ascending. 
        ->orderByRaw('ID1,ID2 ASC')
        ->get();

        // Inisialisasi variabel $ds untuk menyimpan data relasi dalam bentuk matriks
        $ds = array();   
        // Inisialisasi $total_data digunakan untuk menghitung jumlah data relasi.
        $total_data = 0;    
        // Loop melalui data relasi dan menyimpannya dalam array $ds 
        foreach($data['rows'] as $row){
            $ds[$row->ID1][$row->ID2]  = $row->nilai;
            $total_data+=1;
        }  
        // Cek apakah array $ds kosong atau jumlah datanya kurang dari 3
        // Jika kurang dari 3, data status di-set ke 'Kosong', jika tidak, di-set ke 'Isi'
        if(empty($ds) || $total_data < 3){
            $data['status'] = 'Kosong';
        }else{
            $data['status'] = 'Isi';
            // Menghitung nilai total per kolom (sum dari kolom)
            $data['data']=$ds;
            $data['kolom_total'] = $this->get_kolom_total($data['data']); 
            // Normalisasi nilai relasi berdasarkan total per kolom
            $data['normal'] = $this->AHP_normalize($data['data'], $data['kolom_total']);  
            // Mendapatkan nilai rata-rata dari data normalisasi                
            $data['rata'] = $this->AHP_get_rata( $data['normal']);   
            // Menghitung consistency measure (ukuran konsistensi) dari data relasi
            $data['cm'] = $this->AHP_consistency_measure($data['data'], $data['rata']);

            // Update bobot pada model Kriteria berdasarkan nilai rata-rata dari data normalisasi
            foreach ($data['normal'] as $key => $value) {
                $relasi_tabel = Kriteria::where('kode_kriteria', $key)->first();
                $relasi_tabel->bobot = $data['rata'][$key];
                $relasi_tabel->update();
            }
        }
        // Mengembalikan view 'rel_kriteria.index' dengan menggunakan data yang telah diolah
        return view('rel_kriteria.index', $data);
    }

    /**
     * Perbarui data yang ditentukan dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        // Jika ID1 tidak sama dengan ID2 maka tidak perlu diubah
        // Jika sama, maka relasi tersebut adalah relasi antara kriteria yang sama.
        if($request->ID1!=$request->ID2){
            // Update nilai relasi antar kriteria dengan ID1 dan ID2 yang sama
            $rows_data = DB::table('tb_rel_kriteria')
            ->where('ID1', '=', $request->ID1)
            ->where('ID2', '=', $request->ID2)
            ->get();

            foreach ($rows_data as $row) {
             $relasi_tabel = Rel_kriteria::where('ID', $row->ID)->first();
             $relasi_tabel->nilai = $request->nilai;
             $relasi_tabel->update();
            }
            // Update nilai relasi antar kriteria dengan ID1 dan ID2 yang dibalik
            $rows_data = DB::table('tb_rel_kriteria')
            ->where('ID2', '=', $request->ID1)
            ->where('ID1', '=', $request->ID2)
            ->get();

            foreach ($rows_data as $row){
                $relasi_tabel = Rel_kriteria::where('ID', $row->ID)->first();
                $relasi_tabel->nilai = 1/$request->nilai;
                $relasi_tabel->update();
            }
        }
        //mengalihkan pengguna ke halaman rel_kriteria
        return redirect('/rel_kriteria');
    }
    //Fungsi ini digunakan untuk menghitung total dari setiap kolom dalam matriks. 
    //Kode akan menghasilkan array yang berisi total untuk setiap kolom.
    function get_kolom_total($matriks = array()){
        $total = array();        
        foreach($matriks as $key => $value){
            foreach($value as $k => $v){
                @$total[$k]+=$v;
            }
        }  
        return $total;
    }
    //Fungsi ini melakukan normalisasi terhadap matriks dengan membagi setiap elemen dalam matriks 
    //dengan nilai total yang sesuai dari masing-masing kolom. 
    //Output dari fungsi ini adalah matriks yang sudah dinormalisasi.
    function AHP_normalize($matriks = array(), $total = array()){
        foreach($matriks as $key => $value){
            foreach($value as $k => $v){
                $matriks[$key][$k] = $matriks[$key][$k]/$total[$k];
            }
        }     
        return $matriks;       
    }
    
    //Fungsi ini menghitung rata-rata dari setiap baris dalam matriks normalisasi. 
    //Ini akan menghasilkan array yang berisi nilai rata-rata dari setiap baris.
    function AHP_get_rata($normal){
        $rata = array();
        foreach($normal as $key => $value){
            $rata[$key] = array_sum($value)/count($value); 
        } 
        return $rata;   
    }
    
    //Fungsi ini menghitung ukuran konsistensi dengan membagi 
    //hasil perkalian matriks yang sudah dinormalisasi dengan vektor rata-rata. 
    //Output dari fungsi ini adalah array yang berisi ukuran konsistensi untuk setiap baris.
    function AHP_consistency_measure($matriks, $rata){
        $hasil = array();
        $matriks = $this->AHP_mmult($matriks, $rata);    
        foreach($matriks as $key => $value){
            $hasil[$key]=$value/$rata[$key];        
        }
        return $hasil;
    }
    //Fungsi ini melakukan perkalian matriks dengan vektor rata-rata. 
    //Ini akan menghasilkan array yang berisi hasil perkalian matriks dengan vektor rata-rata.
    function AHP_mmult($matriks = array(), $rata = array()){
        $hasil = array();
        $rata = array_values($rata);
        foreach($matriks as $key => $value){
            $no=0;
            foreach($value as $k => $v){
                @$hasil[$key]+=$v*$rata[$no];       
                $no++;  
            }               
        }  
        return $hasil;
    }
}
