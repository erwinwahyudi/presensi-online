@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data File Absensi')

@section('konten')
<div class="row">
	 <div class="col-md-12">
		  <div class="box">
				<div class="box-header with-border">
					 <h3 class="box-title">
						  Data Log Upload
					 </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
						  <table class="table table-bordered table-striped example1">
								<thead>
									 <tr>
										  <th>Nama File</th>
										  <th>Bulan/Tahun</th>
										  <th>Waktu Upload</th>
										  <th>File</th>
									 </tr>
								</thead>
								<tbody>
									@foreach($filelogs as $filelog)
										<tr>
											<td> {{ $filelog->real_name }} </td>
											<td> {{ $filelog->bulan_tahun }} </td>
											<td> {{ $filelog->updated_at }} </td>
											<td> {{ $filelog->filename }} </td>
										</tr>
									@endforeach
								</tbody>
						  </table>
					 </br>
				</div>
				<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
	 </div>
</div>
@stop
