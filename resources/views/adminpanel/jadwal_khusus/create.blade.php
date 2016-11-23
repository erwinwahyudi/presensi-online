@extends('layout.admin_template')
@section('judul_page', 'Manajemen Jadwal Khusus')

@section('konten')
<div class="row">
	 <div class="col-md-12">
		  <!-- Horizontal Form -->
		  <div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">
						  Input Jadwal Khusus
					 </h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				{!! Form::open(['url' => 'jadwal-khusus/create', 'class' => 'form-horizontal']) !!}
						  <div class="box-body">

								  		<!-- Date range -->
		                        <div class="form-group {{ $errors->has('tglrentang') ? 'has-error' : '' }}">
		                            <label class="col-sm-2 control-label" for="inputFingerId">
		                                Rentang Jadwal Khusus
		                            </label>

		                            <div class="col-md-5">
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

								<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
									 <label class="col-sm-2 control-label" for="inputNama">
										  Dalam Rangka
									 </label>
									 <div class="col-sm-4">
										  <input type="text" name="keterangan" class="form-control" placeholder="nama jadwal khusus">
									 </div>
									 <span class="help-block"> {{ $errors->first('keterangan') }} </span>
								</div>

								<!-- checkbox -->
								<div class="form-group">
									 <label class="col-sm-2 control-label" for="inputNama">
										  Absen
									 </label>
										<div class="col-sm-4">
										  <p>
											 <input type="checkbox"  checked disabled> Absen Masuk
											 <input type="hidden" name="absen_masuk" value="1">
										  </p>
										  <p>
											 <input type="checkbox" name="absen_istirahat" id="absen_istirahat" value="1" > Absen Istirahat
										  </p>
										  <p>
											 <input type="checkbox" name="absen_masuk_istirahat" id="absen_masuk_istirahat" value="1" > Absen Masuk Istirahat
										  </p>
										  <p>
											 <input type="checkbox" name="absen_pulang" id="absen_pulang" value="1" > Absen Pulang
										  </p>
										</div>
								</div>

								<hr>

								<!-- time Picker -->
								<div class="form-group">
									 <label class="col-xs-2 control-label">Waktu Absen</label>
									 <div class="col-xs-offset-2 col-xs-3">
										  <label class="control-label"> Hari Biasa </label>
									 </div>

									 <div class="col-xs-offset-2 col-xs-3">
										  <label class="control-label"> Hari Jumat </label>
									 </div>
								</div>

								{{-- masuk --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk" class="form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk" class="form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_jumat"  class="form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_jumat" class="form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- istirahat --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_istirahat" disabled="disabled" class="absen_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_istirahat" disabled="disabled" class="absen_istirahat form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_istirahat_jumat" disabled="disabled" class="absen_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_istirahat_jumat" disabled="disabled" class="absen_istirahat form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- Masuk Istirahat  --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_istirahat" disabled="disabled" class="absen_masuk_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_istirahat" disabled="disabled" class="absen_masuk_istirahat form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_istirahat_jumat" disabled="disabled" class="absen_masuk_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_istirahat_jumat" disabled="disabled" class="absen_masuk_istirahat form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- Pulang --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Pulang </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_pulang" disabled="disabled" class="absen_pulang form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_pulang" disabled="disabled" class="absen_pulang form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Pulang </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_pulang_jumat" disabled="disabled" class="absen_pulang form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_pulang_jumat" disabled="disabled" class="absen_pulang form-control timepicker">
										  </div>
									 </div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="inputNama">Unit Kerja</label>
									<div class="col-sm-4">
										<ul class="list-unstyled">
											@foreach ($data['group'] as $key => $group)
												<li> <h5><b> {{ $group->nama_group }} </b></h5> </li>
													<ul>
													@foreach ($group->kelompok as $kelompok)
														<input type="checkbox" name="id_kelompok[]" value="{{ $kelompok->id }}" class="flat-red"> &nbsp; {{ $kelompok->nama_kelompok }} </p>
												    @endforeach
												    </ul>
												</li>
											@endforeach
										</ul>
									</div>

								</div>
						
						  </div>
						  <!-- /.box-body -->
						  <div class="box-footer">
								<div class="col-sm-offset-2">
									 <button class="btn btn-info btn-flat" type="submit">
										  Simpan
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
