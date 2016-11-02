@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Izin')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Izin
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                              @if(Auth::user()->level == 'admin')
                                <th>Nama</th>
                              @endif
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Kategori</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($izins as $izin)
                              <tr>
                                 @if(Auth::user()->level == 'admin') <td> {{ $izin->nama}} </td> @endif
                                 <td> {{ $izin->tgl_mulai_izin }} </td>
                                 <td> {{ $izin->tgl_selesai_izin }} </td>
                                     <?php
                                          if($izin->dinas==1) {
                                              $dinas = 'Dinas';
                                          } else {
                                              $dinas = 'Non-Dinas';
                                          }
                                     ?>
                                 <td> {{ $dinas }} </td>
                                 <td>
                                   <a href="{{ url('/file_surat/'.$izin->file_surat) }}" class="btn btn-xs btn-success"> Download </a>                                 
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
