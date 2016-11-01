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
                    <input type="hidden" name="userid" value="{{ $data['user']->id }}" id="userid">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pilih Bulan:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="bulantahun" class="form-control pull-right monthpicker" placeholder="Bulan - Tahun" id="bulantahun">
                                </div>
                            </div>
                        </div>                                                
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-offset-2">
                            <button class="btn btn-info btn-flat" type="button" id="ganti_bulan">
                                Proses
                            </button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </input>
            {{-- </form> --}}
        </div>
        <!-- /.box -->
    </div>
</div>

<div class="col-md-4">
  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-green">
      <div class="widget-user-image">
        <img class="img-circle" src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user7-128x128.jpg" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username"> {{ $data['user']->nama }} </h3>
      <h4 class="widget-user-desc"> {{ $data['user']->jabatan }} </h4>
     </div>
  </div>
  <!-- /.widget-user -->
</div>

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
                    <table class="table table-responsive table-bordered table-striped example1">
                    {{-- <table class="table table-bordered table-striped example1"> --}}
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Hri</th>                                
                                <th>Msk</th>
                                <th>Msk Pagi</th>
                                <th>Istrht</th>
                                <th>Msk Siang</th>
                                <th>Pulang</th>
                                <th>Trlambat</th>
                                <th>Ganti Trlambat</th>
                                <th>PSW</th>
                                <th>Izin</th>
                                <th>Ptgn Terlambat</th>
                                <th>Ptgn PSW</th>
                                <th>Ttl Potongan</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['perhitungans'] as $perhitungan)
                                   <tr>
                                         <td>
                                              <a href="{{ url('rekap/log/'.$data['user']->id.'/'.$perhitungan->tanggal) }}" >
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
                                         <td> {{ $perhitungan->izin }} </td>
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

<div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data['masuk'] }} <sup style="font-size: 20px">hari</sup></h3>

                <p>Masuk</p>
            </div>
        </div>
        <div class="small-box bg-green">        
            <div class="inner">
                <h3>{{ $data['tidak_masuk'] }} <sup style="font-size: 20px">hari</sup></h3>

                <p>Tidak Masuk</p>
            </div>
        </div>
    </div>

   <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data['terlambat'] }} <sup style="font-size: 20px">hari</sup></h3>

                <p>Terlambat</p>
            </div>
        </div>
        <div class="small-box bg-green">
            {{-- <div class="inner" style="margin-top: 20px;"> --}}
            <div class="inner">
                <h3>{{ $data['ganti_terlambat'] }} <sup style="font-size: 20px">hari</sup></h3>

                <p>Ganti Terlambat</p>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data['psw'] }} <sup style="font-size: 20px">kali</sup></h3>

                <p>PSW</p>
            </div>
        </div>
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data['izin'] }} <sup style="font-size: 20px">kali</sup></h3>

                <p>Izin</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>00:00 <sup style="font-size: 20px">jam/menit</sup></h3>

                <p>Jumlah Jam Kerja</p>
            </div>
        </div>
    
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $data['total_potongan'] }} <sup style="font-size: 20px">%</sup></h3>

                <p>Total Potongan</p>
            </div>
        </div>
    </div>
</div>

@stop
