@extends('layout.admin_template')
@section('judul_page', 'Manajemen Data Unit Kerja')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Input Data Anggota {{ $group->nama_group }}
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url' => 'unit/'.$unit_id.'/anggota/create', 'class' => 'form-horizontal']) !!}
               <input type="hidden" name="level" value="anggota">
                <input type="hidden" name="group_id" value="{{ $unit_id }}">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('finger_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputFingerId">
                                Finger ID
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputFingerId" name="finger_id" placeholder="finger ID anggota" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('finger_id') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNama">
                                Nama
                            </label>
                            <div class="col-sm-4">
                                <input class="form-control" id="inputNama" name="nama" placeholder="nama anggota" type="text">
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nama') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputNip">
                                Nip
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="nip" class="form-control" id="inputNip"  placeholder="nip anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('nip') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('jabatan') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputJabatan">
                                Jabatan
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="jabatan" class="form-control" id="inputJabatan"  placeholder="jabatan anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('jabatan') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('golongan') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputGolongan">
                                Golongan
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="golongan" class="form-control" id="inputGolongan"  placeholder="golongan anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('golongan') }} </span>
                        </div>

                        <div class="form-group">
                           <label class="col-sm-2 control-label" for="inputFingerGroupId">
                                Unit Kerja
                           </label>
                           <div class="col-sm-4">
                                <input type="text" name="" value="{{ $group->nama_group }}" class="form-control" id="inputFingerGroupId" disabled="">
                           </div>
                           {{-- <span class="help-block"> {{ $errors->first('finger_group_id') }} </span> --}}
                        </div>

                        <div class="form-group">
                           <label class="col-sm-2 control-label">Kelompok</label>
                           <div class="col-sm-4">
                              <select name="kelompok_id" class="form-control select2" style="width: 100%;">
                                    <option value="0"> - </option>
                                @foreach($kelompoks as $kelompok)
                                    <option value="{{ $kelompok->id }}"> {{ $kelompok->nama_kelompok }} </option>
                                @endforeach
                              </select>
                           </div>
                         </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputEmail">
                                Email
                            </label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" id="inputEmail"  placeholder="email anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('email') }} </span>
                        </div>

                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="inputUsername">
                                Username
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="username" class="form-control" id="inputUsername"  placeholder="username anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('username') }}  </span>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label" for="input">
                                Password
                            </label>
                            <div class="col-sm-4">
                                <input type="password" name="password" class="form-control" id="input"  placeholder="password anggota" >
                                </input>
                            </div>
                            <span class="help-block"> {{ $errors->first('') }} </span>
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
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
</div>
@stop
