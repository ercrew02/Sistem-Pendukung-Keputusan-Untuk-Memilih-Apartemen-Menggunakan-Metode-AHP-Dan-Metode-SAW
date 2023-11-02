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
					<h3 class="card-title">Form {{$title}} >> <small><?=$alternatif->nama_alternatif?></small></h3>
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
				<form class="form-horizontal" method="post" action="/relasi_ubah_simpan/{{$alternatif->kode_alternatif}}">
					{{csrf_field() }}
					<div class="card-body">
						@foreach($rows as $row)
						<div class="form-group">
							<label>Kriteria : <strong>{{$row->nama_kriteria}}</strong></label>
							<input type="text" name="{{$row->ID}}" class="form-control" value="{{$row->nilai}}">
						</div> 
						@endforeach

						
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" class="btn btn-info">Simpan <span class="fa fa-save"></span></button>
						<a class="btn btn-danger float-right" href="/relasi">Batal <span class="fa fa-times"></span></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



@endsection