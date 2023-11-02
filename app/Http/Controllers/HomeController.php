<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\Relasi;
use App\Models\pengguna;
use DB;
class HomeController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //Menghitung jumlah alternatif dan kriteria 
        //Untuk ditampilkan di dashboard
        $rows  = Alternatif::all();
        $total_alt = 0;
        foreach($rows as $row){
            $total_alt+=1;
        }

        $rows  = Kriteria::all();
        $total_krt = 0;
        foreach($rows as $row){
            $total_krt+=1;
        }
        $data['total_alt'] = $total_alt;
        $data['total_krt'] = $total_krt;
        $data['title'] = 'Halaman Dashboard';
        return view('welcome', $data);
    }
}
