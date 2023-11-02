@extends('layouts.master')
@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">{{$title}}</h1>
			</div><!-- /.col -->
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
		<!-- Start -->
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<form class="form-inline">
						
					</form>
				</h3>
				<div class="card-tools">
					<ul class="nav nav-pills ml-auto">
						<li class="nav-item">
							<a class="nav-link active" href="/kriteria_tambah"><i class="fa fa-plus"></i> Tambah Data</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<!-- tabel start -->
				<table id="tabeldata" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Kriteria</th>
							<th>Nama Kriteria</th>
							<th>Bobot</th>
							<th>Atribut</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;?>
						@foreach ($rows as $row)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$row->kode_kriteria}}</td>
							<td>{{$row->nama_kriteria}}</td>
							<td>{{$row->bobot}}</td>
							<td>{{$row->atribut}}</td>
							<td><a class="btn btn-sm btn-warning" href="/kriteria_ubah/{{$row->kode_kriteria}}">Ubah <span class="fa fa-edit"></span></a> 
								<a class="btn btn-sm btn-danger" href="/kriteria_hapus/{{$row->kode_kriteria}}" onclick="return confirm('Hapus data?')">Hapus <span class="fa fa-times"></span></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<!-- tabel end -->
			</div>
			<!-- /.card-body -->
		</div>
		<!-- End -->
	</div>
</div>


@endsection