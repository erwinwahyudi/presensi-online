@extends('layout.admin_template')
@section('judul_page', 'Form Izin')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Input Data Izin
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => 'izin', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            
                    <div class="box-body">

                        @if ( Auth::user()->level == 'admin' )
                          <div class="form-group">
                           <label class="col-sm-2 control-label">Pilih User</label>
                           <div class="col-sm-4">
                              <select name="users_id" class="form-control select2" style="width: 100%;">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->nama }} </option>
                                    @endforeach
                              </select>
                           </div>
                          </div>
                        @else
                          <input type="hidden" name="users_id" value="{{ $users }}">
                        @endif
                        <input type="hidden" name="group_id" value="{{ Auth::user()->group_id }}">
                        <div class="form-group {{ $errors->has('tgl_mulai_izin') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputFingerId">
                                Tgl Mulai Izin
                            </label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="tgl_mulai_izin" value="{{ old('tgl_mulai_izin') }}" class="form-control pull-right datepicker" class="form-control pull-right" placeholder="dari tanggal">
                                </div>
                            </div>
                            <span class="help-block"> {{ $errors->first('tgl_mulai_izin') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('tgl_selesai_izin') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputFingerId">
                                Tgl Selesai Izin
                            </label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="tgl_selesai_izin" value="{{ old('tgl_selesai_izin') }}" class="form-control pull-right datepicker" placeholder="sampai tanggal">
                                </div>
                            </div>
                            <span class="help-block"> {{ $errors->first('tgl_selesai_izin') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('dinas') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Kategori Izin
                            </label>
                            <div class="col-sm-4">
                                <input type="radio" name="dinas" value="1" class="flat-red" checked>&nbsp; Dinas
                                &nbsp;
                                <input type="radio" name="dinas" value="0" class="flat-red" >&nbsp; Non Dinas
                            </div>
                            <span class="help-block"> {{ $errors->first('dinas') }} </span>
                        </div>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">Jenis Izin/Cuti</label>
                           <div class="col-sm-4">
                              <select name="kode_izin" class="form-control select2" style="width: 100%;">
                                    @foreach($kat_izins as $kat_izin)
                                        <option value="{{ $kat_izin->kode_izin }}"> {{ $kat_izin->keterangan }} </option>
                                    @endforeach
                              </select>
                           </div>
                        </div>

                         <div class="form-group {{ $errors->has('file_surat') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="exampleInputFile">Upload File Surat</label>
                            <div class="col-sm-4">
                              <input type="file" name="file_surat" id="exampleInputFile">
                              {{-- <p class="help-block">Example block-level help text here.</p> --}}
                            </div>
                            <span class="help-block"> {{ $errors->first('file_surat') }} </span>
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

            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
</div>
@stop
