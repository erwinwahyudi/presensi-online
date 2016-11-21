@extends('layout.admin_template')
@section('judul_page', 'Detail Unit Kerja')

@section('konten')
<div class="row">
		  <div class="col-md-12">
			 <!-- Custom Tabs -->
			 <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#profil" data-toggle="tab">Profil</a></li>
				  <li><a href="#anggota" data-toggle="tab">Anggota</a></li>
				  <li><a href="#kelompok" data-toggle="tab">Kelompok</a></li>
				  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active" id="profil">
					  @include('adminpanel.unit_kerja.profil')
				  </div>
				  <!-- /.tab-pane -->


				  <div class="tab-pane" id="anggota">
						<a href="{{ url('unit/'.$group->id.'/anggota/create') }}" class="btn btn-sm btn-info">Tambah Anggota</a> <br>
						@include('adminpanel.anggota.daftar')
				  </div>
				  <!-- /.tab-pane -->

				  <div class="tab-pane" id="kelompok">
						<a href="{{ url('unit/'.$group->id.'/kelompok/create') }}" class="btn btn-sm btn-info"> Tambah Kelompok </a>
						@include('adminpanel.kelompok.daftar')
				  </div>
				  <!-- /.tab-pane -->

				</div>
				<!-- /.tab-content -->
			 </div>
			 <!-- nav-tabs-custom -->
		  </div>
		  <!-- /.col -->
</div>
@stop
