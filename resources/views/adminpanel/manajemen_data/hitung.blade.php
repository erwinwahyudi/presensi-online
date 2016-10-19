@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data File Absensi')

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
            <form action="/hitung-data" class="form-horizontal" method="POST" >
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pilih Bulan dan Tahun:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="bulantahun" class="form-control pull-right monthpicker" placeholder="Bulan - Tahun">
                                </div>
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
                </input>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>

{{-- tabel view terakhir hitung --}}
{{-- <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Log Upload
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Waktu Hitung</th>
                                <th>Bulan/Tahun</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody> --}}
                           {{-- @foreach($filelogs as $filelog) --}}
                              {{-- <tr>
                                 <td> </td>
                                 <td> <td>
                              </tr> --}}
                           {{-- @endforeach --}}
                        {{-- </tbody>                       
                    </table>
                </br>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div> --}}
@stop
