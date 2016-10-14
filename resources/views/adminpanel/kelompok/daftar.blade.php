
            <div class="box-body">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Nama Kelompok</th>
                                <th>Jumlah Anggota</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($kelompoks as $kelompok)
                              <tr>
                                 <td> {{ $kelompok->nama_kelompok }} </td>
                                 <td> </td>
                                 <td>                                                                                 
                                        {!! Form::open(array('url' => '/unit/'.$kelompok->group_id.'/kelompok/delete/'.$anggota->id, 'method' => 'delete')) !!}
                                          <a class="btn btn-xs btn-success" href="{{ url('unit/'.$kelompok->group_id.'/kelompok/edit/'.$kelompok->id) }}">Ubah</a> 
                                          <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda akan menghapus data?')">Hapus</button>
                                       {!! Form::close() !!}
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>                       
                    </table>
                </br>
            </div>
