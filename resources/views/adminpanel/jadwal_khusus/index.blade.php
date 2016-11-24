@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Jadwal Khusus')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Jadwal Khusus
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               {{-- <div class="row"> --}}
                  <p>
                    <a href="{{ url('jadwal-khusus/create') }} ">
                        <button class="btn btn-info" type="button">
                            Tambah Jadwal
                        </button>
                    </a>
                  </p>
                {{-- </div> --}}
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Nama Jadwal</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['jadwal_khusus'] as $jadwal)
                            <tr>
                                 <td> <a href="{{ url('jadwal-khusus/update/'.$jadwal->id) }}"> {{ $jadwal->keterangan }} </a> </td>
                                 <td>                                                                                 
                                      {!! Form::open(array('url' => 'jadwal-khusus/delete/'.$jadwal->id, 'method' => 'delete')) !!}
                                          <a class="btn btn-xs btn-success" href="{{ url('jadwal-khusus/update/'.$jadwal->id) }}">Ubah</a> 
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
