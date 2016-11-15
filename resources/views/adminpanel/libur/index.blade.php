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
            <form action="" class="form-horizontal" method="POST" >
                {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pilih Rentang Tanggal:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="dari_tgl" class="form-control pull-right datepicker" placeholder="dari tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Keterangan</label>                            
                            <div class="col-md-5">
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="keterangan hari libur"></textarea>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liburs as $libur)
                              <tr>
                                 <td> {{ $libur->nama_bulan }} </td>
                                 <td> {{ $libur->tanggal }} </td>
                                 <td> {{ $libur->keterangan }} </td>
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