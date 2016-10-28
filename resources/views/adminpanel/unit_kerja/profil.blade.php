<form action="unit/update/{{ $group->id }}" class="form-horizontal" method="POST">
    {{ csrf_field() }}
    <input name="active" type="hidden" value="1">
        <div class="box-body">
            <div class="form-group{{ $errors->has('nama_group') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label" for="inputEmail3">
                    Nama Unit
                </label>
                <div class="col-sm-8">
                    <input class="form-control" id="inputEmail3" name="nama_group" placeholder="nama unit kerja" type="text" value="{{ $group->nama_group }} ">
                    </input>
                </div>
                <span class="help-block"> {{ $errors->first('nama_group') }} </span></p>
            </div>                                    
            <div class="form-group{{ $errors->has('finger_group_id') ? 'has-error' : '' }}">
               <label class="col-sm-2 control-label" for="inputFingerGroupId">
                    ID Finger Unit
               </label>
               <div class="col-sm-4">
                    <input class="form-control" id="inputFingerGroupId" name="finger_group_id" placeholder="ID unit kerja" type="number" value="{{ $group->finger_group_id }}">
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