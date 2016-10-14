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

	// menu unit kerja
	Route::get('/unit', 'UnitKerjaController@index'); 
	Route::get('/unit/create', 'UnitKerjaController@create');
	Route::post('/unit/create', 'UnitKerjaController@store');
	Route::get('/unit/edit/{id}', 'UnitKerjaController@edit');
	Route::post('/unit/update/{id}', 'UnitKerjaController@update');
	Route::delete('/unit/delete/{id}', 'UnitKerjaController@destroy');
	Route::get('/unit/{uid}', 'UnitKerjaController@detail');

	// route anggota
	Route::get('/unit/{uid}/anggota/create', 'AnggotaController@create');
	Route::post('/unit/{uid}/anggota/create', 'AnggotaController@store');
	Route::get('/unit/{uid}/anggota/edit/{id}', 'AnggotaController@edit');
	Route::post('/unit/{uid}/anggota/update/{id}', 'AnggotaController@update');
	Route::delete('/unit/{uid}/anggota/delete/{id}', 'AnggotaController@destroy');
	// route update masih belum

	// route kelompok
	Route::get('/unit/{uid}/kelompok/create', 'KelompokController@create');
});

