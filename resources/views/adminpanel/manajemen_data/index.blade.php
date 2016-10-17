@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data File Absensi')

@section('konten')
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Upload File Attlog
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/uploadfile" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="active" type="hidden" value="1">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pilih Bulan:</label>
                            <div class="col-md-4">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="bulantahun" class="form-control pull-right" id="monthpicker" placeholder="Bulan - Tahun">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="exampleInputFile">Upload File</label>
                            <div class="col-sm-8">
                              <input type="file" name="attlogfile" id="exampleInputFile">
                              <p class="help-block">Example block-level help text here.</p>
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
@stop
