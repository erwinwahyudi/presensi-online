<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;

// ambil model
use App\Perhitungan;
use App\Fn;
use App\User;

class KehadiranController extends Controller
{
    public function index() {
    	$tahun  = date('Y');
    		
    		$datas = array();

    		for ($bulan=1; $bulan <= 12 ; $bulan++)
	        {	
	        	  $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
    			  $userid   = '49'; 
		          $groupid  = Auth::user()->group_id;	        	

		  	 	  $masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                      ->where('group_id', $groupid)
	                      ->where('users_id', $userid)
	                      ->where('masuk', '1')->count();

	              $tidak_masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $userid)
	                          ->where('masuk', '0')->count();

	              $terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $userid)
	                          ->where('terlambat', '1')->count();

	              $ganti_terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $userid)
	                          ->where('ganti_terlambat', '1')->count();
	              
	              $psw = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $userid)
	                          ->where('psw', '1')->count();

	              $potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
	                                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                                        ->where('group_id', $groupid)
	                                        ->where('users_id', $userid)
	                                        ->where('kategori_terlambat_id', '!=', '0')->first();
	              $potongan_terlambat = $potongan_terlambat->total_potongan_terlambat;


	              $potongan_psw  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_psw) as total_potongan_psw'))
	                                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                                        ->where('group_id', $groupid)
	                                        ->where('users_id', $userid)
	                                        ->where('kategori_psw_id', '!=', '0')->first();
	              $potongan_psw = $potongan_psw->total_potongan_psw;


	              $total_potongan  = Perhitungan::select('total_potongan', DB::raw('SUM(total_potongan) as total_potongan'))
	                                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                                        ->where('group_id', $groupid)
	                                        ->where('users_id', $userid)->first();
	              $total_potongan = $total_potongan->total_potongan;

	              $datas[$bulan]['bulan']               = $bulan;
	              $datas[$bulan]['user_id']             = $userid;
	              $datas[$bulan]['masuk']               = $masuk;
	              $datas[$bulan]['tidak_masuk']         = $tidak_masuk;
	              $datas[$bulan]['terlambat']           = $terlambat;
	              $datas[$bulan]['ganti_terlambat']     = $ganti_terlambat;
	              $datas[$bulan]['psw']                 = $psw;
	              $datas[$bulan]['potongan_terlambat']  = $potongan_terlambat;
	              $datas[$bulan]['potongan_psw']        = $potongan_psw;
	              $datas[$bulan]['total_potongan']      = $total_potongan;
    	}

    	// echo "<pre>";
    	// print_r($datas);
    	// echo "</pre>";

    	return view('adminpanel.kehadiran.index', compact('datas'));
    }
}
