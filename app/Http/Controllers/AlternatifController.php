<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\Relasi;
use DB;
class AlternatifController extends Controller
{
    /**
     * Menampilkan data alternatif.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Alternatif';
        $data['rows']  = Alternatif::all();
        return view('alternatif.index', $data);
    }

    /**
     * Menampilkan formulir untuk membuat data baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Data Alternatif';
        return view('alternatif.add', $data);
    }

    /**
     * Menyimpan data baru dibuat di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input data
        $validated = $request->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);

        // Cek apakah kode_alternatif sudah ada di database, jika belum, simpan data baru
        // dan juga simpan data baru di tabel Relasi untuk setiap kriteria
        // Jika sudah ada, maka kembalikan dengan pesan error.

        $cek = Alternatif::where('kode_alternatif', $request->kode)->first();
        if(!$cek){
            $alternatif_tabel = new Alternatif;
            $alternatif_tabel->kode_alternatif = $request->kode;
            $alternatif_tabel->nama_alternatif = $request->nama;
            $alternatif_tabel->save();

            $rows_data = DB::table('tb_kriteria')
            ->get();

            foreach ($rows_data as $row) {
                $insert_relasi = new Relasi;
                $insert_relasi->kode_alternatif = $request->kode;
                $insert_relasi->kode_kriteria = $row->kode_kriteria;
                $insert_relasi->nilai = 0;
                $insert_relasi->save();
            }
            return redirect('/alternatif');
        }else{
            return redirect()->back()->with('error', 'kode Sudah ada');
        }
    }

    /**
     * Menampilkan form untuk mengedit data yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = Alternatif::findOrFail($id);
        $data['title'] = 'Ubah Alternatif';
        return view('alternatif.edit', $data);
    }
    // Fungsi ini digunakan untuk menampilkan halaman 
    // untuk mengubah data alternatif yang sudah ada. 
    // Fungsi ini mengambil data alternatif berdasarkan ID-nya 
    // dan mengirimkan data tersebut ke halaman view alternatif.edit.
    
    /**
     * Menyimpan data yang ditentukan dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $validated = $request->validate([
        'nama' => 'required',
    ]);

     $alternatif_tabel = Alternatif::where('kode_alternatif', $id)->first();
     $alternatif_tabel->nama_alternatif = $request->nama;
     $alternatif_tabel->update();
     return redirect('/alternatif');
 }
    /**
     * Hapus data yang ditentukan dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('tb_alternatif')->where('kode_alternatif', '=', $id)->delete();
        DB::table('tb_relasi')->where('kode_alternatif', '=', $id)->delete();
     return redirect('/alternatif');
    }
}
