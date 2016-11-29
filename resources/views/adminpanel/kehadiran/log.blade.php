@extends('layout.admin_template')
@section('judul_page', 'Data Kehadiran')

@section('konten')

{{-- table data unit --}}
<!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-number"> {{ Auth::user()->nama }} </span>
          <span class="info-box-text"> {{ Auth::user()->nip }}  </span>
          {{-- <span class="progress-description"> {{ $user->jabatan }} </span> --}}
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
<!-- /.col -->


{{-- table data unit --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Log Absen
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">               
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attlogs as $attlog)
                                   <tr>
                                         <td> {{ $attlog->date }} </td>                                         
                                         <td> {{ $attlog->time }} </td>
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


{{-- table izin --}}
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
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Keterangan</th>            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($izins as $izin)
                                   <tr>
                                         <td> {{ $izin->tgl_mulai_izin }} </td>                                         
                                         <td> {{ $izin->tgl_selesai_izin }} </td>
                                         <td> {{ $izin->keterangan }} </td>
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
