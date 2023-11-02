<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\Relasi;
use DB;

class HitungController extends Controller
{
    //

	public function index(Request $request)
	{
		
		$data['title'] = 'Perhitungan AHP-SAW';
		$data['rows'] = DB::table('tb_relasi')
		->join('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_relasi.kode_kriteria')
		->join('tb_alternatif', 'tb_alternatif.kode_alternatif', '=', 'tb_relasi.kode_alternatif')
		->orderByRaw('tb_alternatif.kode_alternatif,tb_kriteria.kode_kriteria ASC')
		->get();
		
		$relasi_baru = array();
		$cek_enol=0;
		foreach($data['rows'] as $row){
			if($row->nilai==0){
				$cek_enol+=1;
			}
			$relasi_baru[$row->kode_alternatif][$row->kode_kriteria]  = $row->nilai;
		}
		if(empty($relasi_baru)){
			$data['error_call']='Benar';
		}else{
		if($cek_enol==0){
			$alt = Alternatif::all();
			$ALT = array();
			foreach ($alt as $kyy) {
				$ALT[$kyy->kode_alternatif]=$kyy->nama_alternatif;
			}
			$data['relasi'] = $relasi_baru;
			$data['kriteria'] = Kriteria::all();
			$data['ALTERNATIF'] = $ALT;
			$data['normal'] = $this->SAW_nomalize($relasi_baru);
			$data['hitung'] = $this->hitung($data['normal']);
			$data['rank'] = $this->get_rank($data['hitung']);
			$data['error_call']='Salah';
		}else{
			$data['error_call']='Benar';
		}		
	}
		return view('hitung.index', $data);
	}

	function get_rank($array){
		$data = $array;
		arsort($data);
		$no=1;
		$new = array();
		foreach($data as $key => $value){
			$new[$key] = $no++;
		}
		return $new;
	}

	function SAW_nomalize($array){
		$KRITERIA = array();
		$kriteria_data = Kriteria::all();
		foreach ($kriteria_data as $rw) {
			$KRITERIA[$rw->kode_kriteria]['nama_kriteria']=$rw->nama_kriteria;
			$KRITERIA[$rw->kode_kriteria]['bobot']=$rw->bobot;
			$KRITERIA[$rw->kode_kriteria]['atribut']=$rw->atribut;
		}
		
		$data = array();
		$mm = array();

		foreach($array as $key => $value){
			$temp = array();        
			foreach($value as $k => $v){
				$mm[$k][] = $v;
			}
		}

		foreach($array as $key => $value){                
			foreach($value as $k => $v){
				if($KRITERIA[$k]['atribut']=='Benefit'){
					$data[$key][$k] = $v / max($mm[$k]);
				}else{
					$data[$key][$k] = min($mm[$k]) / $v;
				}
			}
		}
		return $data;
	}

	function hitung($normal){
		$KRITERIA = array();
		$kriteria_data = Kriteria::all();
		foreach ($kriteria_data as $rw) {
			$KRITERIA[$rw->kode_kriteria]['nama_kriteria']=$rw->nama_kriteria;
			$KRITERIA[$rw->kode_kriteria]['bobot']=$rw->bobot;
			$KRITERIA[$rw->kode_kriteria]['atribut']=$rw->atribut;
		}
		$data = array();
		foreach($normal as $key => $value){
			$tot=0;
			foreach($value as $k => $v){                           
				$tot+=$v * $KRITERIA[$k]['bobot']; 
			}        
			$data[$key]= $tot;
		}  
		return $data;
	}

	
}
