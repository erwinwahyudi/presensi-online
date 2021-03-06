@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data File Absensi')

@section('konten')
<div class="row">
	 <div class="col-md-8">
		  <!-- Horizontal Form -->
		  <div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">
						  Upload File Attlog
					 </h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				{!! Form::open(['url' => 'uploadfile', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
					 <input name="active" type="hidden" value="1">
						  <div class="box-body">
								<div class="form-group {{ $errors->has('bulantahun') ? 'has-error' : '' }}">
									 <label class="col-sm-2 control-label">Pilih Bulan:</label>
									 <div class="col-md-4">
										  <div class="input-group date">
											 <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											 </div>
											 <input type="text" name="bulantahun" class="form-control pull-right monthpicker" placeholder="Bulan - Tahun">
										  </div>
									 </div>
									 <span class="help-block"> {{ $errors->first('bulantahun') }} </span>
								</div>

								<div class="form-group {{ $errors->has('attlogfile') ? 'has-error' : '' }}">
									 <label class="col-sm-2 control-label" for="exampleInputFile">Upload File</label>
									 <div class="col-sm-4">
										<input type="file" name="attlogfile" id="exampleInputFile">
									 </div>
									 <span class="help-block"> {{ $errors->first('attlogfile') }}  </span>
								</div>

						  </div>
						  <!-- /.box-body -->
						  <div class="box-footer">
								<div class="col-sm-offset-2">
									 <button class="btn btn-info btn-flat" type="submit">
										  Proses
									 </button>
								</div>
						  </div>
						  <!-- /.box-footer -->
					 </input>
				{!! Form::close() !!}
		  </div>
		  <!-- /.box -->
	 </div>
</div>
@stop
