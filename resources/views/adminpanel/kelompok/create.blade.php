@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Unit Kerja')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Input Data Kelompok {{ $group->nama_group }}
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/unit/{{ $unit_id }}/kelompok/create" class="form-horizontal" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="group_id" value="{{ $unit_id }}">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('nama_kelompok') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nama Kelompok
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_kelompok" class="form-control" id="inputNama"  placeholder="nama kelompok">
                            </div>
                            <span class="help-block"> {{ $errors->first('nama_kelompok') }} </span>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Absen
                            </label>
                              <div class="col-sm-4">
                                <p>
                                  <input type="checkbox" name="absen_masuk" class="flat-red" checked> Absen Masuk
                                </p>
                                <p>
                                  <input type="checkbox" name="absen_istirahat" class="flat-red"> Absen Istirahat
                                </p>
                                <p>
                                  <input type="checkbox" name="absesn_masuk_istirahat" class="flat-red"> Absen Masuk Istirahat
                                </p>
                                <p>
                                  <input type="checkbox" name="absen_pulang" class="flat-red"> Absen Pulang
                                </p>
                              </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Hitung Lembur
                            </label>
                            <div class="col-sm-4">
                                <input type="radio" name="hitung_lembur" value="1" class="flat-red" checked>&nbsp; Ya
                                &nbsp;
                                <input type="radio" name="hitung_lembur" value="0" class="flat-red">&nbsp; Tidak
                            </div>
                        </div>

                        <hr>

                        <!-- time Picker -->
                        <div class="form-group">
                            <label class="col-xs-2 control-label">Waktu Absen</label>                         
                            <div class="col-xs-offset-2 col-xs-3">
                                <label class="control-label"> Hari Biasa </label>
                            </div>

                            <div class="col-xs-offset-2 col-xs-3">
                                <label class="control-label"> Hari Jumat </label>
                            </div>
                        </div>

                        {{-- masuk --}}
                        <div class="form-group">
                            <label class="col-xs-2 control-label"></label>                         
                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Masuk </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_masuk" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_masuk" class="form-control timepicker">
                                </div>
                            </div>

                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Masuk </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_masuk_jumat"  class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_masuk_jumat" class="form-control timepicker">
                                </div>
                            </div>
                        </div>

                        {{-- istirahat --}}
                        <div class="form-group">
                            <label class="col-xs-2 control-label"></label>                         
                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Istirahat </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_istirahat" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_istirahat" class="form-control timepicker">
                                </div>
                            </div>

                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Istirahat </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_istirahat_jumat" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_istirahat_jumat" class="form-control timepicker">
                                </div>
                            </div>
                        </div>

                        {{-- Masuk Istirahat  --}}
                        <div class="form-group">
                            <label class="col-xs-2 control-label"></label>                         
                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_masuk_istirahat" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_masuk_istirahat" class="form-control timepicker">
                                </div>
                            </div>

                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Masuk Istirahat </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_masuk_istrirahat_jumat" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_masuk_istrirahat_jumat" class="form-control timepicker">
                                </div>
                            </div>
                        </div>

                        {{-- Pulang --}}
                        <div class="form-group">
                            <label class="col-xs-2 control-label"></label>                         
                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Pulang </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_pulang" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_pulang" class="form-control timepicker">
                                </div>
                            </div>

                            <div class="col-xs-5">
                                <h5 class="col-xs-3 control-label"> Pulang </h5>
                                <div class=" col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="awal_pulang_jumat" class="form-control timepicker">
                                </div>
                                <div class="col-xs-3 bootstrap-timepicker">
                                    <input type="text" name="akhir_pulang_jumat" class="form-control timepicker">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-offset-2 col-sm-2 control-label" for="inputNama">
                                Penandatangan 1
                            </label>
                        </div>

                        <div class="form-group {{ $errors->has('nama_penandatangan1') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nama
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="nama_penandatangan1" placeholder="nama penandatangan 1" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nama_penandatangan1') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('nip_penandatangan1') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nip
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="nip_penandatangan1" placeholder="nip penandatangan 1" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nip_penandatangan1') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('jabatan_penandatangan1') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Jabatan
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="jabatan_penandatangan1" placeholder="jabatan penandatangan 1" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('jabatan_penandatangan1') }} </span>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-offset-2 col-sm-2 control-label" for="inputNama">
                                Penandatangan 2
                            </label>
                        </div>

                        <div class="form-group {{ $errors->has('nama_penandatangan2') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nama
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="nama_penandatangan2" placeholder="nama penandatangan 2" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nama_penandatangan2') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('nip_penandatangan2') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nip
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="nip_penandatangan2" placeholder="nip penandatangan 2" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nip_penandatangan2') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('jabatan_penandatangan2') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Jabatan
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="jabatan_penandatangan2" placeholder="jabatan penandatangan 2" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('jabatan_penandatangan2') }} </span>
                        </div>
                                           
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-offset-2">
                            <button class="btn btn-info btn-flat" type="submit">
                                Simpan
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
@stop
