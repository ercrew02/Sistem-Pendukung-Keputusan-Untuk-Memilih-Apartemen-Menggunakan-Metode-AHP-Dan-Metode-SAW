<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Relasi;
use DB;

class RelasiController extends Controller
{
    /**
     * Menampilkan semua data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']='Data Nilai Alternatif';
        $data['rows'] = DB::table('tb_relasi')
        ->join('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_relasi.kode_kriteria')
        ->join('tb_alternatif', 'tb_alternatif.kode_alternatif', '=', 'tb_relasi.kode_alternatif')
        ->orderByRaw('tb_alternatif.kode_alternatif,tb_kriteria.kode_kriteria ASC')
        ->get();
        return view('relasi.index', $data);
    }

    /**
     * Tampilkan data yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['rows'] =  DB::table('tb_relasi')
        ->where('kode_alternatif', '=', $id)
        ->join('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_relasi.kode_kriteria')
        ->orderByRaw('kode_alternatif,tb_kriteria.kode_kriteria ASC')
        ->get();
        $data['alternatif'] = Alternatif::findOrFail($id);           
        $data['title'] = 'Nilai Alternatif';
        return view('relasi.edit', $data);
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
        $rows_data = DB::table('tb_relasi')
        ->where('kode_alternatif', '=', $id)
        ->join('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_relasi.kode_kriteria')
        ->orderByRaw('kode_alternatif,tb_kriteria.kode_kriteria ASC')
        ->get();

        foreach ($rows_data as $row) {
           $relasi_tabel = Relasi::where('ID', $row->ID)->first();
           $relasi_tabel->nilai = $request->post($row->ID);
           $relasi_tabel->update();
       }
        return redirect('/relasi');   
   }
}
