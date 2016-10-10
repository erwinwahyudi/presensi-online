@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Unit Kerja')

@section('konten')
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Input Data Anggota
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/unit/{{ $unit_id }}/anggota/create" class="form-horizontal" method="POST">
                {{ csrf_field() }}
                <input name="level" type="hidden" value="anggota">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('finger_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputFingerId">
                                Finger ID
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control" id="inputFingerId" name="finger_id" placeholder="finger ID anggota" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('finger_id') }} </span></p>
                        </div>

                        <div class="form-group{{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputEmail3">
                                Nama
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control" id="inputEmail3" name="nama" placeholder="nama anggota" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nama') }} </span></p>
                        </div>

                        <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNip">
                                Nip
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="nip" class="form-control" id="inputNip"  placeholder="nip anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nip') }}
                        </div>

                        <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputJabatan">
                                Jabatan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="jabatan" class="form-control" id="inputJabatan"  placeholder="jabatan anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('jabatan') }}
                        </div>

                        <div class="form-group {{ $errors->has('golongan') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inpuGolongan">
                                Golongan
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="golongan" class="form-control" id="inputGolongan"  placeholder="golongan anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('golongan') }}
                        </div>

                        <div class="form-group{{ $errors->has('finger_group_id') ? 'has-error' : '' }}">
                           <label class="col-sm-2 control-label" for="inputFingerGroupId">
                                Unit Kerja
                           </label>
                           <div class="col-sm-4">
                                <input class="form-control" id="inputFingerGroupId" name="finger_group_id" placeholder="ID unit kerja" type="number" disabled="">
                           </div>
                           <span class="help-block"> {{ $errors->first('finger_group_id') }} </span>
                        </div>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">Kelompok</label>
                           <div class="col-sm-8">
                              <select name="kelompok_id" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                              </select>
                           </div>
                         </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputEmail">
                                Email
                            </label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" id="inputEmail"  placeholder="email anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('email') }}
                        </div>

                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputUsername">
                                Username
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="username" class="form-control" id="inputUsername"  placeholder="username anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('username') }}
                        </div>

                        <div class="form-group {{ $errors->has('') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="input">
                                Password
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="" class="form-control" id="input"  placeholder=" anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('') }}
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
