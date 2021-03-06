<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	 <meta charset="UTF-8">
	 <title>{{ $page_title or "Presensi Online" }}</title>
	 <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	 <!-- Bootstrap 3.3.2 -->
	 <link href="{{ asset('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	  <!-- Font Awesome -->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	 <!-- Ionicons -->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	 <!-- Theme style -->
	 <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
	 <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
	 <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-green.min.css')}}" rel="stylesheet" type="text/css" />

	 <!-- select2 -->
	 <link href="{{ asset('/bower_components/admin-lte/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

	 <!-- DataTables -->
	 <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css') }}">
	 {{-- <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}"> --}}

	 <!-- Bootstrap time Picker -->
	 <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css') }}">

	 <!-- iCheck for checkboxes and radio inputs -->
	 <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/iCheck/all.css') }}">

	 <!-- bootstrap datepicker -->
	 <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/datepicker/datepicker3.css') }}">

	 <!-- Daterange picker -->
	 <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css') }}" >
	 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	 <!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	 <![endif]-->
	 <style type="text/css">
		  .small-box {
				height: 80px;
				padding: 0px 0px 5px 0px;
				margin-bottom: 5px;
		  }
		  .small-box>.inner {
				padding-left: 30px;
		  }
		  .callout {
				border-radius: 3px;
				margin: 0 0 5px 0;
				padding: 9px 30px 15px 15px;
				border-left: 5px solid #eee;
		  }
		  .nm-group {
				font-weight: bold;
		  }
		  

	 </style>
</head>
<body class="skin-green fixed sidebar-mini">
<div class="wrapper">

	 <!-- Header -->
	 @include('layout.header')

	 <!-- Sidebar -->
	 @include('layout.sidebar')

	 <!-- Content Wrapper. Contains page content -->
	 <div class="content-wrapper">
		  <!-- Content Header (Page header) -->
		  <section class="content-header">
				<h1>
					 @yield('judul_page')
					 <small>{{ $page_description or null }}</small>
				</h1>
				<!-- You can dynamically generate breadcrumbs here -->
				<ol class="breadcrumb">
					 <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
					 <li class="active">Here</li>
				</ol>
		  </section>


		  <!-- Main content -->
		  <section class="content">

				@if( Session::has('pesan_error') )
					 <div class="alert alert-{{ Session::get('status_error') }}">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  {{-- <strong>Title!</strong> --}} {{ Session::get('pesan_error') }}
					 </div>
				@endif

				@yield('konten')
		  </section><!-- /.content -->
	 </div><!-- /.content-wrapper -->

	 <!-- Footer -->
	 @include('layout.footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/bower_components/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/select2/select2.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('/bower_components/admin-lte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js') }}"></script> --}}

<!-- bootstrap time picker -->
<script src="{{ asset('/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<!-- iCheck 1.0.1 -->
<script src="{{ asset('/bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
		Both of these plugins are recommended to enhance the
		user experience -->
<script type="text/javascript">
	$(function () {
		  //Initialize Select2 Elements
		  $(".select2").select2();

		  // datatable
		  $(".example1").DataTable({
				// "ordering": false,
				responsive: true,
		  });
		  $('.example2').DataTable({
			 "ordering": false,
			 "paging": true,
			 "lengthChange": true,
			 "searching": false,
			 "info": true,
			 "autoWidth": false,
			 "responsive": true,
		  });

		  //Timepicker
		  $(".timepicker").timepicker({
			 showInputs: false,
			 showMeridian:false
		  });

		  //iCheck for checkbox and radio inputs
		  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			 checkboxClass: 'icheckbox_minimal-blue',
			 radioClass: 'iradio_minimal-blue'
		  });
		  //Red color scheme for iCheck
		  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			 checkboxClass: 'icheckbox_minimal-red',
			 radioClass: 'iradio_minimal-red'
		  });
		  //Flat red color scheme for iCheck
		  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			 checkboxClass: 'icheckbox_flat-green',
			 radioClass: 'iradio_flat-green'
		  });

		  //Date picker
		  $('.datepicker').datepicker({
			 autoclose: true,
			 format: "yyyy-mm-dd",
		  });

		  $('.monthpicker').datepicker({
				format: "mm/yyyy",
				autoclose: true,
				minViewMode: 'months',
				viewMode: 'months',
				pickTime: false
		  });

		  $('.yearpicker').datepicker({
				format: "yyyy",
				autoclose: true,
				minViewMode: 'years',
				viewMode: 'years',
				pickTime: false
		  });

		  //Date range picker
		  $('#tglrentang').daterangepicker({
				locale: {
				  format: 'YYYY/MM/DD'
				}
		  });


		  $('#ganti_bulan').click(function() {
				var bulantahun = $('#bulantahun').val();
				var userid     = $('#userid').val();
				// alert(bulantahun);
				if(bulantahun !== '') {
					 var link =  '{{ url("rekap") }}/' + bulantahun +'/'+userid;
					 window.location.href = link;
				}
		  });

		  $('#ganti_bulan_user').click(function() {
				var bulantahun = $('#bulantahun').val();
				// alert(bulantahun);
				if(bulantahun !== '') {
					 var link =  '{{ url("kehadiran") }}/' + bulantahun;
					 window.location.href = link;
				}
		  });

		  $('input:radio[name="dinas"]').change(
				function(){
					 if ($(this).val() == '1') {
						  $('#non-dinas').hide();
						  $('#dinas').show();
					 }
					 else if ($(this).val() == '0') {
						  $('#non-dinas').show();
						  $('#dinas').hide();

						  var ket_izin = $('#option_izin :selected').text();
						  $('#ket_izin').val(ket_izin);
						  $('#option_izin').change(function() {
								var ket_izin = $('#option_izin :selected').text();
								$('#ket_izin').val(ket_izin);
						  });
					 }
		  });



		  $('#absen_istirahat').change(function() {			  
			 if(this.checked) {
				 $('.absen_istirahat').prop('disabled', false);
			 } else {
				 $('.absen_istirahat').prop('disabled', true);
			 }
		  });

		  $('#absen_masuk_istirahat').change(function() {
			 if(this.checked) {
				 $('.absen_masuk_istirahat').prop('disabled', false);
			 } else {
				 $('.absen_masuk_istirahat').prop('disabled', true);
			 }
		  });

		  $('#absen_pulang').change(function() {
			 if(this.checked) {
				 $('.absen_pulang').prop('disabled', false);
			 } else {
				 $('.absen_pulang').prop('disabled', true);
			 }
		  });

		  $('#btn-proses').click(function() {
		  		$('#btn-proses').prepend('<i class="fa fa-spin fa-spinner"> </i> &nbsp;');
		  });


	 });
</script>

</body>
</html>
