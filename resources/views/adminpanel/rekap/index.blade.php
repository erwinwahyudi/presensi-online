@extends('layout.admin_template')
@section('judul_page', 'Data Kehadiran')

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
                            <label class="col-sm-2 control-label">Pilih Bulan:</label>
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
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>Nip</th>
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
                            @if($users!=='0')
                                <?php $no=0 ?>
                                @foreach($users as $user)
                                   <tr>
                                         <td> {{ $no+=1 }} </td>
                                         <td> {{ $user->nama }} </td>
                                         <td> {{ $user->nip }} </td>
                                         <td> {{ $user->masuk }} </td>
                                         <td> {{ $user->tidak_masuk }} </td>
                                         <td> {{ $user->terlambat }} </td>
                                         <td> {{ $user->ganti_terlambat }} </td>
                                         <td> {{ $user->psw }} </td>
                                         <td> {{ $user->potongan_terlambat }} % </td>
                                         <td> {{ $user->potongan_psw }} %  </td>
                                         <td> {{ $user->total_potongan }} % </td>
                                         <td>  </td>
                                    </tr>
                                @endforeach
                            @endif
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
