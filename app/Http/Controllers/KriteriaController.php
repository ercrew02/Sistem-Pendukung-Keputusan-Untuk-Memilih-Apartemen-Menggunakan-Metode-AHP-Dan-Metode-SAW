<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Relasi;
use App\Models\Rel_kriteria;
use App\Models\Alternatif;
use DB;

class KriteriaController extends Controller
{
    /**
     * Menampilkan semua data kriteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Kriteria';
        $data['rows'] = Kriteria::all();
        return view('kriteria.index', $data);
    }

    /**
     * Menampilkan form untuk membuat data baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Data Kriteria';
        return view('kriteria.add', $data);
    }

    /**
     * Simpan data yang baru dibuat di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Cek apakah kode_kriteria sudah ada di database, jika belum, simpan data baru
    // dan juga simpan data baru di tabel Relasi untuk setiap kriteria
    // dan juga simpan data baru di tabel Rel_kriteria untuk setiap kriteria
    // Jika sudah ada, maka kembalikan dengan pesan error.
    public function store(Request $request)
    {
        $cek = Kriteria::where('kode_kriteria', $request->kode)->first();

        if(!$cek){
            $validated = $request->validate([
                'kode' => 'required',
                'nama' => 'required',
                'kelompok' => 'required',
            ]);
            $kriteria_tabel = new Kriteria;
            $kriteria_tabel->kode_kriteria = $request->kode;
            $kriteria_tabel->nama_kriteria = $request->nama;
            $kriteria_tabel->atribut = $request->kelompok;
            $kriteria_tabel->save();


            $rows_data = Alternatif::all();
            foreach ($rows_data as $row) {
                $insert_relasi = new Relasi;
                $insert_relasi->kode_alternatif = $row->kode_alternatif;
                $insert_relasi->kode_kriteria = $request->kode;
                $insert_relasi->nilai = 0;
                $insert_relasi->save();
            }

            $rows_data_kriteria = Kriteria::all();
            foreach ($rows_data_kriteria as $row) {
                $insert_rel_kriteria = new Rel_kriteria;
                $insert_rel_kriteria->ID1 = $request->kode;
                $insert_rel_kriteria->ID2 = $row->kode_kriteria;
                $insert_rel_kriteria->nilai = 1;
                $insert_rel_kriteria->save();
            }

            $rows_data_kriteria2 =  DB::table('tb_kriteria')
            ->where('kode_kriteria', '!=', $request->kode)
            ->get();
            foreach ($rows_data_kriteria2 as $row) {
                $insert_rel_kriteria2 = new Rel_kriteria;
                $insert_rel_kriteria2->ID1 = $row->kode_kriteria;
                $insert_rel_kriteria2->ID2 = $request->kode;
                $insert_rel_kriteria2->nilai = 1;
                $insert_rel_kriteria2->save();
            }
        }else{
            return redirect()->back()->with('error', 'kode Sudah ada');
        }
        return redirect('/kriteria');
    }

    /**
     * Menampilkan data yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = Kriteria::findOrFail($id);
        $data['title'] = 'Ubah Kriteria';
        return view('kriteria.edit', $data);
    }

    /**
     * Menampilkan form untuk mengedit data yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Perbarui data yang ditentukan dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kelompok' => 'required',
        ]);
    
         $kriteria_tabel = Kriteria::where('kode_kriteria', $id)->first();
         $kriteria_tabel->nama_kriteria = $request->nama;
         $kriteria_tabel->atribut = $request->kelompok;
         $kriteria_tabel->update();
         return redirect('/kriteria');
    }

    /**
     * Menghapus data yang ditentukan dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tb_kriteria')->where('kode_kriteria', '=', $id)->delete();
        DB::table('tb_relasi')->where('kode_kriteria', '=', $id)->delete();
        DB::table('tb_rel_kriteria')->where('ID1', '=', $id)->delete();
        DB::table('tb_rel_kriteria')->where('ID2', '=', $id)->delete();
     return redirect('/kriteria');
    }
}
