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
                    <input type="hidden" name="userid" value="{{ $user->id }}" id="userid">
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

<!-- /.col -->
<div class="col-md-4 col-sm-6 col-xs-12">
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
                            @foreach($perhitungans as $perhitungan)
                                   <tr>
                                         <td>
                                              <a href="{{ url('/rekap/log/'.$user->id.'/'.$perhitungan->tanggal) }}" >
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

@stop
