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
		
		<div class="row">
			<div class="col-lg-6 col-6">
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?=$total_krt?></h3>
						<p>Kriteria</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="/kriteria" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-6 col-6">
				<div class="small-box bg-success">
					<div class="inner">
					<h3><?=$total_alt?></h3>
						<p>Alternatif</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="/alternatif" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fas fa-exclamation-triangle"></i>
							Proses AHP SAW
						</h3>
					</div>

					<div class="card-body">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5></i> Proses AHP</h5>
							Pemrosesan AHP digunakan untuk mencari bobot Kriteria berdasarkan perbandingan antar kriteria terdapat pada menu Nilai Kriteria.
						</div>
						<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5></i> Proses SAW</h5>
							Setelah didapatkan bobot kriteria dari proses AHP dilakukan proses perhitungan SAW untuk perangkingan perbandingan Alternatif berdasarkan inputan di Nilai Alternatif.
						</div>
						<div class="alert bg-yellow alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5></i>Ketentuan</h5>
							Data Alternatif dan Kriteria harus lebih dari 1. <br/>
							Kode Alternatif dan Kriteria harus berbeda 1 dengan yang lainnya.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection