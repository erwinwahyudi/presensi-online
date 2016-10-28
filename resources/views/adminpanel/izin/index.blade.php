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
            <form action="{{ url('izin') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('tgl_mulai_izin') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputFingerId">
                                Tgl Mulai Izin
                            </label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="tgl_mulai_izin" class="form-control pull-right datepicker" placeholder="dari tanggal">
                                </div>
                            </div>
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
                                  <input type="text" name="tgl_selesai_izin" class="form-control pull-right datepicker" placeholder="sampai tanggal">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">Jenis Izin/Cuti</label>
                           <div class="col-sm-4">
                              <select name="kode_izin" class="form-control select2" style="width: 100%;">
                                    <option value="0"> - </option>
                                {{-- @foreach($kelompoks as $kelompok) --}}
                                    {{-- <option value="{{ $kelompok->id }}"> {{ $kelompok->nama_kelompok }} </option> --}}
                                {{-- @endforeach --}}
                              </select>
                           </div>
                         </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label" for="exampleInputFile">Upload File Surat</label>
                            <div class="col-sm-8">
                              <input type="file" name="file_surat" id="exampleInputFile">
                              {{-- <p class="help-block">Example block-level help text here.</p> --}}
                            </div>
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
