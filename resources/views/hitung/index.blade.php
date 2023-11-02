@extends('layouts.master')
@section('content')
@if($error_call=='Benar')
<div class="alert alert-dismissible alert-warning">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4 class="alert-heading">Informasi Error!</h4>
	<p class="mb-0">Terdapat data yang bernilai 0 atau belum ada data. silahkan di ubah di menu nilai alternatif atau isikan data terlebih dahulu</p>
</div>
@else
<!-- <?php print_r($rows);?> -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">{{$title}}</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">{{$title}}</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="content">
	<div class="container-fluid">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					Nilai Alternatif
				</h3>
			</div>
			<div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							{{-- judul kolom --}}
							@foreach(current($relasi) as $key => $value)
							<th>{{$key}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						{{-- menampilkan data nilai alternatif --}}
						@foreach($relasi as $key => $value)
						<tr>
							<th>{{$key}}</th>
							@foreach($value as $k => $v)
							<td>{{$v}}</td>
							@endforeach
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					Normalisasi SAW
				</h3>
			</div>
			<div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							@foreach(current($relasi) as $key => $value)
							<th>{{$key}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach($normal as $key => $value)
						<tr>
							<th>{{$key}}</th>
							@foreach($value as $k => $v)
							<td>{{$v}}</td>
							@endforeach
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					Hasil Akhir
				</h3>
			</div>
			<div class="card-body">
				<table  class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Nama</th>
							@foreach(current($relasi) as $key => $value)
							<th>{{$key}}</th>
							@endforeach
							<th>Total</th>
							<th>Rank</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th colspan="2">Bobot Kriteria dari AHP</th>
							@foreach($kriteria as $row)
							<th>{{$row->bobot}}</th>
							@endforeach
						</tr>
						<?php 
						$KRITERIA = array();
						foreach ($kriteria as $rw) {
							$KRITERIA[$rw->kode_kriteria]['nama_kriteria']=$rw->nama_kriteria;
							$KRITERIA[$rw->kode_kriteria]['bobot']=$rw->bobot;
							$KRITERIA[$rw->kode_kriteria]['atribut']=$rw->atribut;
						}
						?>
						@foreach($normal as $key => $value)
						<tr>
							<th>{{$key}}</th>
							<th>{{$ALTERNATIF[$key]}}</th>
							<?php foreach($value as $k => $v):?>
								<td><?=$KRITERIA[$k]['bobot']*$v?></td>
							<?php endforeach;?>
							<th>{{$hitung[$key]}}</th>
							<th>{{$rank[$key]}}</th>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endif
@endsection