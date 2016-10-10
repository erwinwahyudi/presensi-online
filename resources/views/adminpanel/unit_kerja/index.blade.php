@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Unit Kerja')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Unit Kerja
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               {{-- <div class="row"> --}}
                  <p>
                    <a href="{{ url('/unit/create') }} ">
                        <button class="btn btn-info" type="button">
                            Tambah Unit
                        </button>
                    </a>
                  </p>
                {{-- </div> --}}
                <br>
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Unit Kerja</th>
                                <th>Unit ID</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($groups as $group)
                              <tr>
                                 <td> {{ $group->nama_group }} </td>
                                 <td> {{ $group->finger_group_id }} </td>
                                 <td>                                                                                 
                                        {!! Form::open(array('url' => '/unit/delete/'.$group->id, 'method' => 'delete')) !!}
                                          <a class="btn btn-xs btn-success" href="{{ url('unit/edit/'.$group->id) }}">Ubah</a> 
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
