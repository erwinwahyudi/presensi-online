@extends('layout.admin_template')
@section('judul_page', 'Data Kehadiran User')

@section('konten')
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Pilih Bulan
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/rekap" class="form-horizontal" method="POST">
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pilih Tahun:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="tahun" class="form-control pull-right yearpicker" placeholder="Tahun">
                                </div>
                            </div>
                        </div>                                                
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-offset-2">
                            <button class="btn btn-info btn-flat" type="submit">
                                Proses
                            </button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </input>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>


{{-- table data unit --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Kehadiran Unit Kerja
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Masuk</th>
                                <th>Tidak Masuk</th>
                                <th>Terlambat</th>
                                <th>Ganti Terlambat</th>
                                <th>PSW</th>
                                <th>Potongan Terlambat</th>
                                <th>Potongan PSW</th>
                                <th>Total Potongan</th>
                                <th>Jlh Jam Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($datas as $key => $data)
                                   <tr>
                                         <td> 
                                              <a href="{{ url('/kehadiran/'.$data['bulan'].'/'.$data['tahun']) }}" >
                                                     {{ $data['bulan'] }} 
                                              </a>
                                         </td>
                                         <td> {{ $data['masuk'] }} </td>
                                         <td> {{ $data['tidak_masuk'] }} </td>
                                         <td> {{ $data['terlambat'] }} </td>
                                         <td> {{ $data['ganti_terlambat'] }} </td>
                                         <td> {{ $data['psw'] }} </td>
                                         <td> {{ $data['potongan_terlambat'] }} % </td>
                                         <td> {{ $data['potongan_psw'] }} %  </td>
                                         <td> {{ $data['total_potongan'] }} % </td>
                                         <td>  </td>
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
