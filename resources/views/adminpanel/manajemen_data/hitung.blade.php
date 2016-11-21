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
								<div class="col-md-12">
									  <div class="callout callout-default"> Tanggal terakhir hitung &nbsp; <h5 class="label label-warning"> {{ $tanggal }} </h5> </div>
								</div>

								<p></p>

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


@stop
