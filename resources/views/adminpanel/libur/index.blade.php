@extends('layout.admin_template')
@section('judul_page', 'Manajemen Hari Libur')

@section('konten')
<div class="row">
		<div class="col-md-8">
				<!-- Horizontal Form -->
				<div class="box box-info">
						<div class="box-header with-border">
								<h3 class="box-title">
										Hitung Data
								</h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
					{!! Form::open(['url' => 'libur/create', 'class' => 'form-horizontal']) !!}

										<div class="box-body">
												<div class="form-group {{ $errors->has('tgl_libur') ? 'has-error' : '' }}">
														<label class="col-sm-3 control-label">Tanggal Libur:</label>
														<div class="col-md-4">
																<div class="input-group date">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar"></i>
																	</div>
																	<input type="text" name="tgl_libur" class="form-control pull-right datepicker" placeholder="tanggal libur">
																</div>
														</div>
														<span class="help-block"> {{ $errors->first('tgl_libur') }} </span>
												</div>
												<div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
														<label class="col-sm-3 control-label">Keterangan</label>
														<div class="col-md-5">
																<textarea name="keterangan" class="form-control" rows="3" placeholder="keterangan hari libur"></textarea>
														</div>
														<span class="help-block"> {{ $errors->first('keterangan') }} </span>
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

{{-- tabel view terakhir hitung --}}
<div class="row">
		<div class="col-md-12">
				<div class="box">
						<div class="box-header with-border">
								<h3 class="box-title">
										Daftar Libur
								</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
										<table class="table table-bordered table-striped example2">
												<thead>
														<tr>
																<th>Bulan</th>
																<th>Tangal</th>
																<th>Keterangan</th>
																<th>Tindakan</th>
														</tr>
												</thead>
												<tbody>
														@foreach($data['libur'] as $libur)
															<tr>
																<td> {{ $libur->nama_bulan }} </td>
																<td> {{ $libur->tgl }} </td>
																<td> {{ $libur->keterangan }} </td>
																<td>
																		{!! Form::open(array('url' => 'libur/delete/'.$libur->id, 'method' => 'delete')) !!}
																			<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda akan menghapus data?')">Hapus</button>
																		{!! Form::close() !!}
																</td>
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
