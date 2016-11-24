@extends('layout.admin_template')
@section('judul_page', 'Manajemen Admin')

@section('konten')
<div class="row">
		<div class="col-md-8">
				<!-- Horizontal Form -->
				<div class="box box-success">
						<div class="box-header with-border">
								<h3 class="box-title">
										Tambah Admin
								</h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
					{!! Form::open(['url' => 'tambah-admin/create', 'class' => 'form-horizontal']) !!}

							<div class="box-body">
									<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
											<label class="col-sm-3 control-label">Nama</label>
											<div class="col-md-4">
													<input type="text" name="nama" class="form-control pull-right" placeholder="nama admin">
											</div>
											<span class="help-block"> {{ $errors->first('nama') }} </span>
									</div>
									<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
											<label class="col-sm-3 control-label">Username</label>
											<div class="col-md-4">
													<input type="text" name="username" class="form-control pull-right" placeholder="username admin">
											</div>
											<span class="help-block"> {{ $errors->first('username') }} </span>
									</div>
									<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
											<label class="col-sm-3 control-label">Password</label>
											<div class="col-md-4">
													<input type="password" name="password" class="form-control pull-right" placeholder="password login">
											</div>
											<span class="help-block"> {{ $errors->first('password') }} </span>
									</div>
									<div class="form-group {{ $errors->has('konfirmasi_password') ? 'has-error' : '' }}">
											<label class="col-sm-3 control-label">Konfirmasi Password</label>
											<div class="col-md-4">
													<input type="password" name="konfirmasi_password" class="form-control pull-right" placeholder="konfirmasi password">
											</div>
											<span class="help-block"> {{ $errors->first('konfirmasi_password') }} </span>
									</div>
									<div class="form-group">
			                           <label class="col-sm-3 control-label">Level Admin</label>
			                           <div class="col-sm-4">
			                              <select name="level" class="form-control" style="width: 100%;">
			                                <option value="admin"> Admin Unit Kerja </option>
			                                <option value="superadmin"> Super Admin </option>
			                              </select>
			                           </div>
			                        </div>
			                        <div class="form-group">
				                        <label class="col-sm-3 control-label">Unit Kerja</label>
				                        <div class="col-sm-4">
				                            <select name="group_id" class="form-control select2" style="width: 100%;">
			                                    <option value="0"> - </option>
				                                @foreach($data['groups'] as $group)
				                                    <option value="{{ $group->id }}"> {{ $group->nama_group }} </option>
				                                @endforeach
				                            </select>
				                        </div>
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
										Daftar Admin
								</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
										<table class="table table-bordered table-striped example2">
												<thead>
														<tr>
																<th width="5%">No</th>
																<th>Nama</th>
																<th>Group</th>
																<th>Tindakan</th>
														</tr>
												</thead>
												<tbody>
														<?php $no=1; ?>
														@foreach($data['users'] as $user)
															<tr>
																<td width="5%"> {{ $no++ }} </td>
																<td> {{ $user->nama }} </td>
																<td> {{ $user->group->nama_group }} </td>
																<td>
																		{!! Form::open(array('url' => 'tambah-admin/delete/'.$user->id, 'method' => 'delete')) !!}
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
