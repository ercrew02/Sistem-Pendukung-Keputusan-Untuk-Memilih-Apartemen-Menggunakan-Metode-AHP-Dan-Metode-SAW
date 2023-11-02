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
					<li class="breadcrumb-item"><a href="/home">Home</a></li>
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
				<form class="form-inline">
					{{csrf_field() }}
					
				</form>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<!-- tabel start -->
				<?php 
				$data = array();        
				foreach($rows as $row){
					$data[$row->kode_alternatif][$row->kode_kriteria] = $row->nilai;
				}
				if(!empty($data)):
					?>
					<table id="tabeldata" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>&nbsp;</th>
								@foreach(current($data) as $key => $value)
								<th>{{$key}}</th>
								@endforeach
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key => $value)
							<tr>
								<th>{{$key}}</th>
								@foreach($value as $k => $v)
								<td>{{$v}}</td>
								@endforeach
								<td><a class="btn btn-sm btn-warning" href="/relasi_ubah/{{$key}}">Ubah <span class="fa fa-edit"></span></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				<?php endif;?>
				<!-- tabel end -->
			</div>
			<!-- /.card-body -->
			
		</div>
		<!-- End -->
	</div>
</div>


@endsection