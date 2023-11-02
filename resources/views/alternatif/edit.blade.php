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
		<div class="col-md-6">
			<div class="card card-secondary">
				<div class="card-header">
					<h3 class="card-title">Form {{$title}}</h3>
				</div>

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form class="form-horizontal" method="post" action="/alternatif_ubah_simpan/{{$row->kode_alternatif}}">
					{{csrf_field() }}
					<div class="card-body">
						<div class="form-group">
							<label>Kode Alternatif</label>
							<input type="text" name="kode" class="form-control" value="{{$row->kode_alternatif}}" readonly>
						</div>
						<div class="form-group">
							<label>Nama Alternatif</label>
							<input type="text" name="nama" class="form-control" value="{{$row->nama_alternatif}}">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info">Simpan <span class="fa fa-save"></span></button>
							<a class="btn btn-danger" href="/alternatif">Batal <span class="fa fa-times"></span></a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection