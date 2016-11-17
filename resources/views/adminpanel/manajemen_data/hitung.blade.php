@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data File Absensi')

@section('konten')
<div class="row">
	 <div class="col-md-8">
		  <!-- Horizontal Form -->
		  <div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">
						  Hitung Data
					 </h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				{!! Form::open(['url' => 'hitung-data', 'class' => 'form-horizontal']) !!}
						  <div class="box-body">
								<div class="form-group">
									 <label class="col-sm-3 control-label">Pilih Rentang Tanggal:</label>
									 <div class="col-md-4">
										  <div class="input-group date">
											 <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											 </div>
											 <input type="text" name="dari_tgl" class="form-control pull-right datepicker" placeholder="dari tanggal">
										  </div>
									 </div>
									 <div class="col-md-4">
										  <div class="input-group date">
											 <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											 </div>
											 <input type="text" name="sampai_tgl" class="form-control pull-right datepicker" placeholder="sampai tanggal">
										  </div>
									 </div>
								</div>

								<!-- Date range -->
							  <div class="form-group {{ $errors->has('tglrentang') ? 'has-error' : '' }}">
									<label class="col-sm-3 control-label" for="inputFingerId">
										Rentang Tanggal Hitung
									</label>

									<div class="col-md-8">
										<div class="input-group">
											  <div class="input-group-addon">
												 <i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control pull-right" id="tglrentang" name="tglrentang">
										</div>
									</div>
									<span class="help-block"> {{ $errors->first('tglrentang') }} </span>
							  </div>
							  <!-- /.form group -->
							  <div class="box-footer">
									<div class="col-sm-offset-3">
										 <button class="btn btn-info btn-flat" type="submit">
											  Proses
										 </button>
									</div>
							  </div>

						  </div>
						  <!-- /.box-body -->

						  <!-- /.box-footer -->
					 </input>
				{!! Form::close() !!}
		  </div>
		  <!-- /.box -->
	 </div>
</div>

{{-- tabel view terakhir hitung --}}
{{-- <div class="row">
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
										  <th>Waktu Hitung</th>
										  <th>Bulan/Tahun</th>
										  <th>File</th>
									 </tr>
								</thead>
								<tbody> --}}
									{{-- @foreach($filelogs as $filelog) --}}
										{{-- <tr>
											<td> </td>
											<td> <td>
										</tr> --}}
									{{-- @endforeach --}}
								{{-- </tbody>
						  </table>
					 </br>
				</div>
				<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
	 </div>
</div> --}}
@stop
