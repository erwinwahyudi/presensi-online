<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

	 <!-- sidebar: style can be found in sidebar.less -->
	 <section class="sidebar">

		  <!-- Sidebar user panel (optional) -->
		  <div class="user-panel">
				<div class="pull-left image">
					 <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
				</div>
				<div class="pull-left info">
					 <p>{{ Auth::user()->nama }}</p>
					 <!-- Status -->
					 <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
				</div>
		  </div>

		  <!-- search form (Optional) -->
		  <!-- <form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					 <input type="text" name="q" class="form-control" placeholder="Search..."/>
					 <span class="input-group-btn">
						<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
					 </span>
				</div>
		  </form> -->
		  <!-- /.search form -->

		  <!-- Sidebar Menu -->
		  <ul class="sidebar-menu">
				<li class="header">Menu</li>
				<!-- Optionally, you can add icons to the links -->
				@if( (Auth::user()->level == 'admin') )
					 <li {{ current_page('rekap') ? 'class=active' : '' }} ><a href="{{ url('rekap') }}"><i class="fa fa-file-text-o"></i><span>Data Kehadiran</span></a></li>
				@endif

				@if( (Auth::user()->level == 'admin') || (Auth::user()->level == 'superadmin') )
					 <li {{ current_page('unit') ? 'class=active' : '' }}><a href="{{ url('unit') }}"><i class="fa fa-users"></i><span>Unit Kerja</span></a></li>
					 <li {{ current_page('libur') ? 'class=active' : '' }}><a href="{{ url('libur') }}"><i class="fa fa-calendar-check-o"></i><span>Hari Libur</span></a></li>
				@endif

				@if( (Auth::user()->level == 'admin') )
					 <li class="treeview {{ current_page('manajemen-data') ? 'active' : '' }}  {{ current_page('hitung-data') ? 'active' : '' }} {{ current_page('logupload') ? 'active' : '' }}">
						  <a href="#"><i class="fa fa-database"></i><span>Manajemen Data</span> <i class="fa fa-angle-left pull-right"></i></a>
						  <ul class="treeview-menu">
								<li><a href="{{ url('manajemen-data') }}">Upload File</a></li>
								<li><a href="{{ url('hitung-data') }}">Hitung</a></li>
								<li><a href="{{ url('logupload') }}">Log Upload</a></li>
						  </ul>
					 </li>
				@endif

				@if(Auth::user()->level == 'superadmin')
					<li {{ current_page('tambah-admin') ? 'class=active' : '' }}><a href="{{ url('tambah-admin') }}"><i class="fa fa-user-secret"></i><span>Admin</span></a></li>
					<li {{ current_page('jadwal-khusus') ? 'class=active' : '' }}><a href="{{ url('jadwal-khusus') }}"><i class="fa fa-calendar"></i><span><span>Jadwal Khusus</span></a></li>
				@endif

				@if(Auth::user()->level == 'anggota')
					 <li {{ current_page('kehadiran') ? 'class=active' : '' }} ><a href="{{ url('kehadiran') }}"><i class="fa fa-file-text-o"></i><span>Kehadiran</span></a></li>
				@endif

				@if(Auth::user()->level == 'anggota' || Auth::user()->level == 'admin')
					 <li class="treeview {{ current_page('izin') ? 'active' : '' }} {{ current_page('log-izin') ? 'active' : '' }}">
						  <a href="#"><i class="fa fa-calendar-times-o"></i><span>Izin</span> <i class="fa fa-angle-left pull-right"></i></a>
						  <ul class="treeview-menu">
								<li><a href="{{ url('izin') }}">Form Izin</a></li>
								<li><a href="{{ url('log-izin') }}">Log Izin</a></li>
						  </ul>
					 </li>
				@endif

				<li {{ current_page('ubah-pass') ? 'class=active' : '' }}><a href="{{ url('ubah-pass') }}"><i class="fa fa-lock"></i><span>Ubah Password</span></a></li>
				<li><a href="{{ url('logout') }}"><i class="fa fa-power-off"></i><span>Logout</span></a></li>
		  </ul><!-- /.sidebar-menu -->
	 </section>
	 <!-- /.sidebar -->
</aside>
