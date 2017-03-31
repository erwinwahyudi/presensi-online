
				<div class="box-body">
						  <table class="table table-bordered table-striped example1">
								<thead>
									 <tr>
										  <th>Nama</th>
										  <th>Username</th>
										  <th>Kelompok</th>
										  <th>Tindakan</th>
									 </tr>
								</thead>
								<tbody>
									@foreach($anggotas as $anggota)
										<tr>
											<td> {{ $anggota->nama }} </td>
											<td> {{ $anggota->username }}</td>
											<td> {{ $anggota->nama_kelompok }}</td>
											<td>
													 {!! Form::open(array('url' => 'unit/'.$anggota->group_id.'/anggota/delete/'.$anggota->id, 'method' => 'delete')) !!}
														<a class="btn btn-xs btn-success" href="{{ url('unit/'.$anggota->group_id.'/anggota/edit/'.$anggota->id_user) }}">Ubah</a>
														<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda akan menghapus data?')">Hapus</button>
													{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
								</tbody>
						  </table>
					 </br>
				</div>
