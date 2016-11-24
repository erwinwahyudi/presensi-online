@extends('layout.admin_template')
@section('judul_page', 'Manajemen Jadwal Khusus')

@section('konten')
<div class="row">
	 <div class="col-md-12">
		  <!-- Horizontal Form -->
		  <div class="box box-success">
				<div class="box-header with-border">
					 <h3 class="box-title">
						  Update Jadwal Khusus
					 </h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				{!! Form::open(['url' => 'jadwal-khusus/update/'.$data['jadwal']->id, 'class' => 'form-horizontal']) !!}
						  <div class="box-body">

								
								<div class="form-group {{ $errors->has('tglrentang') ? 'has-error' : '' }}">
		                            <label class="col-sm-2 control-label" for="inputFingerId">
		                                Rentang Jadwal Khusus
		                            </label>

		                            <div class="col-md-5">
		                            	<div class="input-group">
		                                	<h5 class="label label-info">{{ date('j F Y', strtotime($data['jadwal']->tanggal_mulai)) }}</h5> 
		                                	&nbsp; sampai  &nbsp;
		                                	<h5 class="label label-info"> {{ date('j F Y', strtotime($data['jadwal']->tanggal_selesai)) }}</h5>
		                                </div>
		                            </div>
		                            <span class="help-block"> {{ $errors->first('tglrentang') }} </span>
		                        </div>

		                        <div class="form-group {{ $errors->has('tglrentang') ? 'has-error' : '' }}">
		                            <label class="col-sm-2 control-label" for="inputFingerId">
		                                Rentang Jadwal Khusus
		                            </label>

		                            <div class="col-md-5">
		                                <div class="input-group">
		                                    <div class="input-group-addon">
		                                      <i class="fa fa-calendar"></i>
		                                    </div>
		                                    <input type="text" class="form-control pull-right" id="tglrentang" name="tglrentang" value="{{ $data['jadwal']->tanggal_mulai }} - {{ $data['jadwal']->tanggal_selesai }}">
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
										  <input type="text" name="keterangan" value="{{ $data['jadwal']->keterangan }}" class="form-control" placeholder="nama jadwal khusus">
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
											 <input type="checkbox" name="absen_istirahat" id="absen_istirahat" @if($data['jadwal']->absen_istirahat=='1') value="1" checked @else value="0" @endif > Absen Istirahat
										  </p>
										  <p>
											 <input type="checkbox" name="absen_masuk_istirahat" id="absen_masuk_istirahat" @if($data['jadwal']->absen_masuk_istirahat=='1') value="1" checked @else value="0" @endif > Absen Masuk Istirahat
										  </p>
										  <p>
											 <input type="checkbox" name="absen_pulang" id="absen_pulang" @if($data['jadwal']->absen_pulang=='1') value="1" checked @else value="0" @endif > Absen Pulang
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
												<input type="text" name="awal_masuk" value="{{ $data['jadwal']->awal_masuk }}" class="form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk" value="{{ $data['jadwal']->akhir_masuk }}" class="form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_jumat" value="{{ $data['jadwal']->awal_masuk_jumat }}"  class="form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_jumat" value="{{ $data['jadwal']->akhir_masuk_jumat }}" class="form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- istirahat --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_istirahat" @if($data['jadwal']->absen_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_istirahat }}" @endif class="absen_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_istirahat" @if($data['jadwal']->absen_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_istirahat }}" @endif class="absen_istirahat form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_istirahat_jumat" @if($data['jadwal']->absen_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_istirahat_jumat }}" @endif class="absen_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_istirahat_jumat" @if($data['jadwal']->absen_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_istirahat_jumat }}" @endif class="absen_istirahat form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- Masuk Istirahat  --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_istirahat" @if($data['jadwal']->absen_masuk_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_masuk_istirahat }}" @endif class="absen_masuk_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_istirahat" @if($data['jadwal']->absen_masuk_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_masuk_istirahat }}" @endif class="absen_masuk_istirahat form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_masuk_istirahat_jumat" @if($data['jadwal']->absen_masuk_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_masuk_istirahat_jumat }}" @endif class="absen_masuk_istirahat form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_masuk_istirahat_jumat" @if($data['jadwal']->absen_masuk_istirahat == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_masuk_istirahat_jumat }}" @endif class="absen_masuk_istirahat form-control timepicker">
										  </div>
									 </div>
								</div>

								{{-- Pulang --}}
								<div class="form-group">
									 <label class="col-xs-2 control-label"></label>
									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Pulang </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_pulang" @if($data['jadwal']->absen_pulang == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_pulang }}" @endif class="absen_pulang form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_pulang" @if($data['jadwal']->absen_pulang == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_istirahat }}" @endif class="absen_pulang form-control timepicker">
										  </div>
									 </div>

									 <div class="col-xs-5">
										  <h5 class="col-xs-3 control-label"> Pulang </h5>
										  <div class=" col-xs-3 bootstrap-timepicker">
												<input type="text" name="awal_pulang_jumat" @if($data['jadwal']->absen_pulang == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->awal_pulang_jumat }}" @endif class="absen_pulang form-control timepicker">
										  </div>
										  <div class="col-xs-3 bootstrap-timepicker">
												<input type="text" name="akhir_pulang_jumat" @if($data['jadwal']->absen_pulang == '0') disabled="disabled" value="00:00" @else value="{{ $data['jadwal']->akhir_pulang_jumat }}" @endif class="absen_pulang form-control timepicker">
										  </div>
									 </div>
								</div>

								<hr>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="inputNama">Unit Kerja</label>
									<div class="col-sm-4">
										<ul class="list-unstyled">
											@foreach ($data['groups'] as $group)
												<li> <h5><b> {{ $group->nama_group }} </b></h5> </li>
													<ul>
													@foreach ($group->kelompok as $kelompok)
														<input type="checkbox" name="kelompok_id[]" value="{{ $kelompok->id }}" @if(isset($data['kelompok_array'][$kelompok->id])) checked="checked" @endif class="flat-red"> &nbsp; {{ $kelompok->nama_kelompok }} </p>
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
