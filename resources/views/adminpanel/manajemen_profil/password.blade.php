@extends('layout.admin_template')
@section('judul_page', 'Manajemen Password')

@section('konten')
<div class="row">
		<div class="col-md-9">
				<!-- Horizontal Form -->
				<div class="box box-success">
						<div class="box-header with-border">
								<h3 class="box-title">
										Form Ubah Password
								</h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
					{!! Form::open(['url' => 'ubah-pass', 'class' => 'form-horizontal']) !!}

										<div class="box-body">
												{{-- <div class="form-group {{ $errors->has('password_lama') ? 'has-error' : '' }}">
														<label class="col-sm-3 control-label">Password Lama </label>
														<div class="col-md-4">
																<input type="password" name="password_lama" value="{{ old('password_lama') }}" class="form-control pull-right" placeholder="password lama">
														</div>
														<span class="help-block"> {{ $errors->first('password_lama') }} </span>
												</div> --}}
												<div class="form-group {{ $errors->has('password_baru') ? 'has-error' : '' }}">
														<label class="col-sm-3 control-label">Password Baru </label>
														<div class="col-md-4">
																<input type="password" name="password_baru" class="form-control pull-right" placeholder="password baru">
														</div>
														<span class="help-block"> {{ $errors->first('password_baru') }} </span>
												</div>
												<div class="form-group {{ $errors->has('konfirmasi_password') ? 'has-error' : '' }}">
														<label class="col-sm-3 control-label">Konfirmasi Password</label>
														<div class="col-md-4">
																<input type="password" name="konfirmasi_password" class="form-control pull-right" placeholder="ketik ulang password baru">
														</div>
														<span class="help-block"> {{ $errors->first('konfirmasi_password') }} </span>
												</div>
										</div>
										<!-- /.box-body -->
										<div class="box-footer">
												<div class="col-sm-offset-3">
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
