@extends('layout.admin_template')
@section('judul_page', 'Halaman Dashboard')

@section('konten')
	<div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
        	@if(Auth::user()->level == 'anggota')
		        <span class="info-box-number"> {{ $data['user']->nama }} </span>
		        <span class="info-box-text"> {{ $data['user']->nip }}  </span>
          		<h4 class="label label-warning flat"> {{ $data['user']->group->nama_group }} </h4>
          	@elseif (Auth::user()->level == 'admin')
          		<span class="info-box-number"> {{ $data['user']->nama }} </span>
		        <span class="info-box-text"> {{ $data['user']->level }}  </span>
		        <h4 class="label label-warning flat"> {{ $data['user']->group->nama_group }} </h4>
          	@else
          		<span class="info-box-number"> {{ $data['user']->nama }} </span>
		        <h4 class="label label-warning flat"> {{ $data['user']->level }} </h4>
		    @endif
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

	<div class="row">
	    <div class="col-md-12">
	        <!-- Horizontal Form -->
	        <div class="box box-success">
	            <div class="box-header with-border">
	                <h3 class="box-title">
	                    Peraturan absen karyawan Universitas Tanjungpura
	                </h3>
	            </div>

	            <div class="box-body">
				<center> 
						<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vQ5L_d-ymY1Pp7vOJGyeHmlPEbi_UxmIY9qiG369EpQxGq9m6U-rxFiylL0Ze0-1jsofgMBIs1EXnO2/embed?start=true&loop=true&delayms=10000" frameborder="0" width="800" height="500" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
				</center>
				</div>
			</div>
		</div>
	</div>
@stop