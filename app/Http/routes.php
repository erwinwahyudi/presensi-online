<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//set halaman default untuk admin
Route::auth();



Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');

	Route::group(['middleware' => 'adminsuperadmin'], function () {
		// route anggota
		Route::get('/unit/{uid}/anggota/create', 'AnggotaController@create');
		Route::post('/unit/{uid}/anggota/create', 'AnggotaController@store');
		Route::get('/unit/{uid}/anggota/edit/{id}', 'AnggotaController@edit');
		Route::post('/unit/{uid}/anggota/update/{id}', 'AnggotaController@update');
		Route::delete('/unit/{uid}/anggota/delete/{id}', 'AnggotaController@destroy');

		// route kelompok
		Route::get('/unit/{uid}/kelompok/create', 'KelompokController@create');
		Route::post('/unit/{uid}/kelompok/create', 'KelompokController@store');
		Route::get('/unit/{uid}/kelompok/edit/{id}', 'KelompokController@edit');
		Route::post('unit/{uid}/kelompok/update/{id}', 'KelompokController@update');
		Route::delete('/unit/{uid}/kelompok/delete/{id}', 'KelompokController@destroy');

		// menu unit kerja
		Route::get('/unit', 'UnitKerjaController@index');
		Route::get('/unit/create', 'UnitKerjaController@create');
		Route::post('/unit/create', 'UnitKerjaController@store');
		Route::get('/unit/edit/{id}', 'UnitKerjaController@edit');
		Route::post('/unit/update/{id}', 'UnitKerjaController@update');
		Route::delete('/unit/delete/{id}', 'UnitKerjaController@destroy');
		Route::get('/unit/{uid}', 'UnitKerjaController@detail');

		//Route manajemen data
		Route::get('/manajemen-data', 'ManajemenDataController@index');
		Route::post('/uploadfile', 'ManajemenDataController@uploadfile');

		//Route logfile upload
		Route::get('/logupload', 'ManajemenDataController@logupload');

		//Route untuk hitung data
		Route::get('/hitung-data', 'ManajemenDataController@indexhitung');
		Route::post('/hitung-data', 'ManajemenDataController@hitung');

		//Route rekap data harian
		Route::get('/rekap', 'RekapController@index');
		Route::post('/rekap', 'RekapController@rekap_group');
		Route::get('/rekap/log/{uid}/{tgl}', 'RekapController@log');
		Route::get('/rekap/{bln}/{thn}/{uid}', 'RekapController@rekap_user');

		//Route CRUD libur
		Route::get('/libur', 'LiburController@index');
		Route::post('/libur/create', 'LiburController@create');
		Route::delete('/libur/delete/{id}', 'LiburController@delete');

		// route untuk pdf
		Route::get('/group/pdf/{bln}/{thn}/{kid}/{gid}', 'PdfController@print_group');
		Route::get('/detil/pdf/{bln}/{thn}/{kid}/{gid}', 'PdfController@print_detil_all');
		Route::get('/kartu/pdf/{bln}/{thn}/{kid}/{gid}', 'PdfController@kartu');
	});


	Route::group(['middleware' => 'superadmin'], function () {
		Route::get('/jadwal-khusus', 'JadwalKhususController@index');
		Route::get('/jadwal-khusus/create', 'JadwalKhususController@create');
		Route::post('/jadwal-khusus/create', 'JadwalKhususController@store');
		Route::get('/jadwal-khusus/update/{id}', 'JadwalKhususController@edit');
		Route::post('/jadwal-khusus/update/{id}', 'JadwalKhususController@update');
		Route::delete('/jadwal-khusus/delete/{id}', 'JadwalKhususController@destroy');

		Route::get('/tambah-admin', 'AdminController@index');
		Route::post('/tambah-admin/create', 'AdminController@create');
		Route::delete('/tambah-admin/delete/{id}', 'AdminController@delete');
	});

	Route::group(['middleware' => 'anggotaadmin'], function () {
		//Route untuk izin
		Route::get('/izin', 'IzinController@index');
		Route::post('/izin', 'IzinController@create');
		Route::get('/log-izin', 'IzinController@log');
	});

	Route::group(['middleware' => 'anggota'], function () {
		//Route rekap data harian
		Route::get('/kehadiran', 'KehadiranController@index');
		Route::post('/kehadiran', 'KehadiranController@rekap_tahun');
		Route::get('/kehadiran/log/{tgl}', 'KehadiranController@log_hadir');
		Route::get('/kehadiran/{bln}/{thn}', 'KehadiranController@detail');
	});

	Route::get('/ubah-pass', 'ManajemenProfilController@index');
	Route::post('/ubah-pass', 'ManajemenProfilController@edit_pass');
});
