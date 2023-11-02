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
			<div class="card card-outline card-secondary">
				<div class="card-header">
					<h3 class="card-title">Form {{$title}}</h3>
				</div>
				@if (\Session::has('error'))
					<div class="alert alert-danger">
						<ul>
							<li>{!! \Session::get('error') !!}</li>
						</ul>
					</div>
				@endif
				<form class="form-horizontal" method="post" action="/kriteria_simpan">
					{{csrf_field() }}
					<div class="card-body">
						<div class="form-group">
							<label>Kode Kriteria</label>
							<input type="text" name="kode" class="form-control" value="{{Request::input('kode')}}">
						</div> 
						<div class="form-group">
							<label>Nama Kriteria</label>
							<input type="text" name="nama" class="form-control" value="{{Request::input('nama')}}">
						</div> 
						<div class="form-group">
							<label>Atribut</label>
							<select class="form-control" name="kelompok">
								<option>Benefit</option>
								<option>Cost</option>
							</select>
						</div>       
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" class="btn btn-info">Simpan <span class="fa fa-save"></span></button>
						<a class="btn btn-danger float-right" href="/kriteria">Batal <span class="fa fa-times"></span></a>
					</div>
					<!-- /.card-footer -->
				</form>
			</div>
		</div>
	</div>
</div>
@endsection