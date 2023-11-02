@extends('layouts.master')
@section('content')
@if($status=='Kosong')
<div class="alert alert-dismissible alert-warning">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4 class="alert-heading">Informasi Error!</h4>
	<p class="mb-0">Anda Belum Menginputkan minimal 3 kriteria</p>
</div>
@else
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
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form class="form-inline" method="post" action="/rel_kriteria_ubah">
					{{csrf_field() }}
					<div class="form-group">
						<select class="form-control" name="ID1">
							@foreach($kriteria_data as $row)
							<option value="{{$row->kode_kriteria}}">{{$row->nama_kriteria}}</option>
							@endforeach
						</select>
					</div>
					{{-- nilai kepentingan perbandingan kriteria --}}
					<div class="form-group">
						<select class="form-control" name="nilai">
							<option value="1">1 - Sama penting dengan</option>
							<option value="2">2 - Mendekati sedikit lebih penting dari</option>
							<option value="3">3 - Sedikit lebih penting dari</option>
							<option value="4">4 - Mendekati lebih penting dari</option>
							<option value="5">5 - Lebih penting dari</option>
							<option value="6">6 - Mendekati sangat penting dari</option>
							<option value="7">7 - Sangat penting dari</option>
							<option value="8">8 - Mendekati mutlak dari</option>
							<option value="9">9 - Mutlak sangat penting dari</option>                        
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" name="ID2">
							@foreach($kriteria_data as $row)
							<option value="{{$row->kode_kriteria}}">{{$row->nama_kriteria}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</button>
					</div>
				</form>
			</div>
			<!-- /.card-header -->
			<?php
			//array asosiatif
			$KRITERIA= array();
			foreach ($kriteria_data as $rw) {
				$KRITERIA[$rw->kode_kriteria]['nama_kriteria']=$rw->nama_kriteria;
			}
			?>
			<div class="card-body">
				<div class="panel-heading"><strong>Matriks Perbandingan Berpasangan Kriteria</strong></div>  
				<table class="table table-bordered table-hover table-striped">
					<thead><tr>
						<th>Kode</th>
						<th>Nama</th>
						@foreach($KRITERIA as $key => $val)
						<th>{{$key}}</th>
						@endforeach
					</tr></thead>
					<tbody>
						<?php
						
						$a=1;
						$no=1;
						foreach($data as $key => $val):?>
							<tr>
								<td><?=$key?></td>
								<td><?=$KRITERIA[$key]['nama_kriteria']?></td>
								<?php  
								$b=1;
								foreach($val as $k => $v){ 
									if( $key == $k ) 
										$class = 'success';
									elseif($b > $a)
										$class = 'danger';
									else
										$class = '';

									echo "<td class='$class'>".round($v, 3)."</td>";   
									$b++;            
								} 
								$no++;       
								?>
							</tr>
							<?php $a++; endforeach;?>
						</tbody>
						<tfoot><tr>
							<td colspan="2" class="text-right">Total</td>
							<?php foreach($kolom_total as $key => $val):?>
								<td><?=round($val, 3)?></td>
							<?php endforeach?>
						</tr></tfoot>         
					</table>

						<div class="panel panel-primary">
							<div class="panel-heading"><strong>Normalisasi Matriks (Bobot Prioritas)</strong></div>
							<div class="panel-body"> 
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead><tr>
											<th>Kode</th>
											<?php foreach($KRITERIA as $key => $val):?>
												<th><?=$key?></th>
											<?php endforeach?>
											<th>Jumlah</th>
											<th>Rata-rata</th>
										</tr></thead>
										<?php                                                          
										foreach($normal as $key => $val):
                                        // $db->query("UPDATE tb_kriteria SET bobot='$rata[$key]' WHERE kode_kriteria='$key'");
											$total_a=0;
											?>
											<tr>
												<td><?=$key?></td>
												<?php foreach($val as $k => $v):
													$total_a+=$v;?>
													<td><?=round($v, 3)?></td>
												<?php endforeach?>   
												<td><?=round($total_a, 3)?></td> 
												<td><?=round($rata[$key], 3)?></td>             
											</tr>                        
										<?php endforeach?>                       
									</table>
									
									<div class="panel-heading"><strong>Perhitungan Nilai Matriks Penjumlahan Setiap Baris Kriteria</strong></div>
									<table class="table table-bordered table-striped table-hover">
										<thead><tr>
											<th>Kode</th>
											<?php foreach($KRITERIA as $key => $val):?>
												<th><?=$key?></th>
											<?php endforeach?>
											<th>Jumlah</th>
										</tr></thead>
										<?php       
										$caling = array();                                                   
										foreach($data as $key => $val):
                                        // $db->query("UPDATE tb_kriteria SET bobot='$rata[$key]' WHERE kode_kriteria='$key'");
											$total_a=0;
											?>
											<tr>
												<td><?=$key?></td>
												<?php foreach($val as $k => $v):
													$total_a+=($v*max($rata));?>
													<td><?=round(($v*max($rata)), 3)?></td>
												<?php endforeach;
												$caling[$key]=$total_a;?>   
												<td><?=round($total_a, 3)?></td>    
											</tr>                        
										<?php endforeach?>                       
									</table>

									
									<div class="panel-heading"><strong>Matriks Rasio Konsistensi</strong></div>
									<table class="table table-bordered table-striped table-hover">
										<thead><tr>
											<th>Kode</th>
											<th>Jumlah</th>
											<th>Prioritas</th>
											<th>Hasil</th>
										</tr></thead>
										<?php       
									         
										$total_akhir = 0;                                         
										foreach($rata as $key => $val):
											$total_akhir+=($val * $caling[$key]);
											?>
											<tr>
												<td><?=$key?></td>
												<td><?=round($caling[$key], 3)?></td>  
												<td><?=round($val, 3)?></td> 
												<td><?=round($val * $caling[$key], 3)?></td>    
											</tr>                        
										<?php endforeach?>       
										<tr>
											<th colspan="3">Total</th>
											<th>{{round($total_akhir, 3)}}</th>
										</tr>                
									</table>
								</div>
							</div>

							<div class="panel-body">
								<p>Berikut tabel ratio index berdasarkan ordo matriks.</p>     
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<?php
											// nilai Rasio Index
											$nRI = array (
												1=>0,
												2=>0,
												3=>0.58,
												4=>0.9,
												5=>1.12,
												6=>1.24,
												7=>1.32,
												8=>1.41,
												9=>1.46,
												10=>1.49,
												11=>1.51,
												12=>1.48,
												13=>1.56,
												14=>1.57,
												15=>1.59
												); 
											?>
											<tr>
											<th>Ordo matriks</th>
											<?php foreach($nRI as $key => $val):?>
												<?php if(count($data)==$key):?>
													<td class="text-primary"><strong><?=$key?></strong></td>
												<?php else:?>
													<td><?=$key?></td>
												<?php endif?>
											<?php endforeach?>
											</tr>
										</thead>

										<tr>
											{{-- implementasi nilai Rasio Index --}}
											<th>Ratio index</th>
											<?php foreach($nRI as $key => $val):?>
												<?php if(count($data)==$key):?>
													<td class="text-primary"><strong><?=$val?></strong></td>
												<?php else:?>
													<td><?=$val?></td>
												<?php endif?>
											<?php endforeach?>
										</tr>
									</table>
								</div>
							</div>

							<div class="panel-footer">
								<?php
								$lm = $total_akhir / count($KRITERIA);
								$CI =   ($lm - count($KRITERIA))/(count($KRITERIA)-1);
								$RI = $CI / $nRI[count($KRITERIA)];
										
								echo "<p>Lambda Max: ".round($lm, 3)."<br />";
								echo "Consistency Index: ".round($CI, 3)."<br />";  
								echo "Consistency Ratio: ".round($RI, 3);
								// $hh = "";
								if($RI>0.10){
									echo " (Tidak konsisten)<br />";    
									// $hh = 'Tidak Konsisten';
								} else {
									// $hh = 'Konsisten';
									echo " (Konsisten)<br />";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
					{{-- <script type="text/javascript">
						$(document).ready(function() {
							var alert1 = "<?=$hh?>";
							alert("Hasil AHP Menyatakan : "+ alert1);
						})
					</script> --}}
@endif
@endsection