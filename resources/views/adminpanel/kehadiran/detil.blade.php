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
            <form action="" class="form-horizontal" method="POST">
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

<!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-number"> {{ $user->nama }} </span>
          <span class="info-box-text"> {{ $user->nip }}  </span>
          {{-- <span class="progress-description"> {{ $user->jabatan }} </span> --}}
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
<!-- /.col -->

{{-- <!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-blue">
    <div class="inner">
      <h3>4 kali</h3>

      <p>Total Terlambat</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
  </div>
</div>
<!-- ./col --> --}}


{{-- table data unit --}}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Data Kehadiran User
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">               
                <br>
                    <table class="table table-bordered table-striped example1">
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Hari</th>                                
                                <th>Masuk</th>
                                <th>Msk Pagi</th>
                                <th>Istirahat</th>
                                <th>Msk Siang</th>
                                <th>Pulang</th>
                                <th>Terlambat</th>
                                <th>Ganti Terlambat</th>
                                <th>PSW</th>
                                <th>Potongan Terlambat</th>
                                <th>Potongan PSW</th>
                                <th>Total Potongan</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perhitungans as $perhitungan)
                                   <tr>
                                         <td>
                                              <a href="{{ url('/kehadiran/log/'.$perhitungan->tanggal) }}" >
                                                     {{ $perhitungan->tanggal }} 
                                              </a> 
                                         </td>
                                         <td> {{ $perhitungan->hari }} </td>                                         
                                         <td> {{ $perhitungan->masuk }} </td>
                                         <td> {{ $perhitungan->masuk_pagi }} </td>
                                         <td> {{ $perhitungan->istirahat }} </td>
                                         <td> {{ $perhitungan->masuk_siang }} </td>
                                         <td> {{ $perhitungan->pulang }} </td>
                                         <td> {{ $perhitungan->terlambat }} </td>
                                         <td> {{ $perhitungan->ganti_terlambat }} </td>
                                         <td> {{ $perhitungan->psw }} </td>
                                         <td> {{ $perhitungan->potongan_terlambat }} % </td>
                                         <td> {{ $perhitungan->potongan_psw }} %  </td>
                                         <td> {{ $perhitungan->total_potongan }} % </td>
                                         <td> {{ $perhitungan->keterangan }} </td>
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
