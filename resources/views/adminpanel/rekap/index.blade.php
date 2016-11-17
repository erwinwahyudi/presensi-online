@extends('layout.admin_template')
@section('judul_page', 'Data Kehadiran')

@section('konten')
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Pilih Bulan
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => 'rekap', 'class' => 'form-horizontal']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pilih Bulan:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="bulantahun" required="" class="form-control pull-right monthpicker" placeholder="Bulan - Tahun">
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
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
</div>


{{-- table data unit --}}
@if($data['kelompok_array']!=='0')
                                
    @foreach($data['kelompok_array'] as $key => $kelompok)
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ $kelompok->nama_kelompok }}
                    </h3>
                    <div class="row">
                      <div class="col-md-1 pull-right" style="padding-left:5px;">
                          <a class="btn btn-sm btn-success btn-flat" target="_BLANK" href="{{ url('detil/pdf/'.$data['bulan'].'/'.$data['tahun'].'/'.$kelompok->id.'/'.Auth::user()->group_id) }}">Cetak Detil</a> 
                      </div>
                      <div class="col-md-1 pull-right">
                          <a class="btn btn-sm btn-success btn-flat" target="_BLANK" href="{{ url('group/pdf/'.$data['bulan'].'/'.$data['tahun'].'/'.$kelompok->id.'/'.Auth::user()->group_id) }}">Cetak</a> 
                      </div>
                      <div class="col-md-1 pull-right">
                          <a class="btn btn-sm btn-success btn-flat" target="_BLANK" href="{{ url('kartu/pdf/'.$data['bulan'].'/'.$data['tahun'].'/'.$kelompok->id.'/'.Auth::user()->group_id) }}">Cetak Kartu</a> 
                      </div>
                    </div>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <br>
                        <table class="table table-bordered table-striped example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>Masuk</th>
                                    <th>Tdk Masuk</th>
                                    <th>Terlambat</th>
                                    <th>Ganti Terlambat</th>
                                    <th>PSW</th>
                                    <th>Izin</th>
                                    <th>Ptgn Terlambat</th>
                                    <th>Ptgn PSW</th>
                                    <th>Ttl Potongan</th>
                                    <th>Jlh Jam Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no=0; ?>
                               @foreach($kelompok->user as $user)
                                       <tr>
                                             <td> {{ $no+=1 }} </td>
                                             <td> 
                                                  <a href="{{ url('rekap/'.$data['bulan'].'/'.$data['tahun'].'/'.$user->id) }}" > 
                                                        {{ $user->nama }} 
                                                  </a>
                                             </td>
                                             <td> {{ $user->nip }} </td>
                                             <td> {{ $user->masuk }} </td>
                                             <td> {{ $user->tidak_masuk }} </td>
                                             <td> {{ $user->terlambat }} </td>
                                             <td> {{ $user->ganti_terlambat }} </td>
                                             <td> {{ $user->psw }} </td>
                                             <td> {{ $user->izin }} </td>
                                             <td> {{ $user->potongan_terlambat }} % </td>
                                             <td> {{ $user->potongan_psw }} %  </td>
                                             <td> {{ $user->total_potongan }} % </td>
                                             <td> {{ $user->total_jam_kerja }} jam/menit  </td>
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
    @endforeach

@endif

@stop
