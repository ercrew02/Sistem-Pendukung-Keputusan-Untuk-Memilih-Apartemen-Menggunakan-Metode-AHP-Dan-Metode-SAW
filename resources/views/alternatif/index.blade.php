@extends('layouts.master')
@section('content')

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
		<!-- Start -->
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">
					<form class="form-inline">
						{{csrf_field() }}
					</form>
				</h3>
				<div class="card-tools">
					<ul class="nav nav-pills ml-auto">
						<li class="nav-item">
							<a class="nav-link active" href="/alternatif_tambah"><i class="fa fa-plus"></i> Tambah Data</a>
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
							<th>Kode Alternatif</th>
							<th>Nama Alternatif</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1;
						?>
						@foreach ($rows as $row)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$row->kode_alternatif}}</td>
							<td>{{$row->nama_alternatif}}</td>
							<td>
								<a class="btn btn-sm btn-warning" href="/alternatif_ubah/{{$row->kode_alternatif}}">Ubah <span class="fa fa-edit"></span></a> 
								<a class="btn btn-sm btn-danger" href="/alternatif_hapus/{{$row->kode_alternatif}}" onclick="return confirm('Hapus data?')">Hapus <span class="fa fa-times"></span></a> </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	@endsection