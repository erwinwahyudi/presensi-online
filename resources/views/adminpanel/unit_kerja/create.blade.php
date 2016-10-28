@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Unit Kerja')

@section('konten')
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Input Data Unit
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="unit/create" class="form-horizontal" method="POST">
                {{ csrf_field() }}
                <input name="active" type="hidden" value="1">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('nama_group') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputEmail3">
                                Nama Unit
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control" id="inputEmail3" name="nama_group" placeholder="nama unit kerja" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nama_group') }} </span></p>
                        </div>
                        <!-- <div class="form-group">
                           <label class="col-sm-2 control-label">Sub Unit</label>
                           <div class="col-sm-10">
                              <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                              </select>
                           </div>
                         </div> -->
                        <div class="form-group{{ $errors->has('finger_group_id') ? 'has-error' : '' }}">
                           <label class="col-sm-2 control-label" for="inputFingerGroupId">
                                ID Finger Unit
                           </label>
                           <div class="col-sm-4">
                                <input class="form-control" id="inputFingerGroupId" name="finger_group_id" placeholder="ID unit kerja" type="number">
                           </div>
                           <span class="help-block"> {{ $errors->first('finger_group_id') }} </span>
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
