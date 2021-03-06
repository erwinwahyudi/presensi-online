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
use App\Attlog;

class KehadiranController extends Controller
{
    public function index() {
    	$tahun  = date('Y');
    		
    		$datas = array();

    		for ($bulan=1; $bulan <= 12 ; $bulan++)
	        {	
	        	  $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
    			  $userid   = Auth::user()->id; 
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

	              $jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
      						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
      						                        ->where('users_id', $userid)->first();
				  $jam_kerja = $jam_kerja->jam_kerja;

				  $total_jam_kerja	= Fn::total_jam_kerja($jam_kerja);

	              $datas[$bulan]['tahun']				= $tahun;
	              $datas[$bulan]['bulan_indo']          = Fn::to_bulan($bulan);
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
	              $datas[$bulan]['jam_kerja']			= $total_jam_kerja;
    	}

    	// echo "<pre>";
    	// print_r($datas);
    	// echo "</pre>";

    	return view('adminpanel.kehadiran.index', compact('datas'));
    }

    public function rekap_tahun(Request $request) {
    	$tahun  = $request->tahun;
    		
    		$datas = array();

    		for ($bulan=1; $bulan <= 12 ; $bulan++)
	        {	
	        	  $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
    			  $userid   = Auth::user()->id; 
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

	              $jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
      						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
      						                        ->where('users_id', $userid)->first();
				  $jam_kerja = $jam_kerja->jam_kerja;

				  $total_jam_kerja	= Fn::total_jam_kerja($jam_kerja);

	              $datas[$bulan]['tahun']				= $tahun;
	              $datas[$bulan]['bulan_indo']          = Fn::to_bulan($bulan);
	              $datas[$bulan]['bulan']               = $bulan;	
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
	              $datas[$bulan]['jam_kerja']			= $total_jam_kerja;
    	}

    	return view('adminpanel.kehadiran.index', compact('datas'));
    }

    public function detail($bln, $thn)
    {
    	$groupid    = Auth::user()->group_id;
    	$user_id    = Auth::user()->id;
    	$tahun		= $thn;
    	$bulan 		= $bln;

    	$data['perhitungans'] = Perhitungan::where('users_id', $user_id)
    								->where('group_id', $groupid)
    								->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
    								->orderBy('tanggal', 'asc')->get();

    	$data['user'] = User::where('id', $user_id)
					 ->where('group_id', $groupid)->first();

		$data['kelompok'] 	= DB::table('kelompok')->where('id', $data['user']->kelompok_id)->first();
		$data['group'] 		= DB::table('group')->where('id', $data['user']->group_id)->first();

		$data['masuk'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		      ->where('group_id', $groupid)
		      ->where('users_id', $user_id)
		      ->where('masuk', '1')->count();

		$data['tidak_masuk'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		          ->where('group_id', $groupid)
		          ->where('users_id', $user_id)
		          ->where('masuk', '0')->count();

		$data['terlambat'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		          ->where('group_id', $groupid)
		          ->where('users_id', $user_id)
		          ->where('terlambat', '1')->count();

		$data['ganti_terlambat'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		          ->where('group_id', $groupid)
		          ->where('users_id', $user_id)
		          ->where('ganti_terlambat', '1')->count();

		$data['psw'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		          ->where('group_id', $groupid)
		          ->where('users_id', $user_id)
		          ->where('psw', '1')->count();

		$data['izin'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		          ->where('group_id', $groupid)
		          ->where('users_id', $user_id)
		          ->where('izin', '1')
		          ->where('masuk', '0')->count();

		$potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
		                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		                        ->where('group_id', $groupid)
		                        ->where('users_id', $user_id)
		                        ->where('kategori_terlambat_id', '!=', '0')->first();
		$potongan_terlambat  = $potongan_terlambat->total_potongan_terlambat;


		$potongan_psw  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_psw) as total_potongan_psw'))
		                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		                        ->where('group_id', $groupid)
		                        ->where('users_id', $user_id)
		                        ->where('kategori_psw_id', '!=', '0')->first();
		$potongan_psw = $potongan_psw->total_potongan_psw;


		$total_potongan  = Perhitungan::select('total_potongan', DB::raw('SUM(total_potongan) as total_potongan'))
		                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
		                        ->where('group_id', $groupid)
		                        ->where('users_id', $user_id)->first();
		$data['total_potongan'] = $total_potongan->total_potongan;

		$jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
	                                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                                        ->where('group_id', $groupid)
	                                        ->where('users_id', $user_id)->first();
		$jam_kerja = $jam_kerja->jam_kerja;

		$data['total_jam_kerja']	= Fn::total_jam_kerja($jam_kerja);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

    	return view('adminpanel.kehadiran.detil', compact('perhitungans', 'data'));
    }

    public function log_hadir($tgl)
    {
    	$user_id 	= Auth::user()->id;
    	$groupid    = Auth::user()->group_id;
    	$fingerid   = Auth::user()->finger_id;

    	$attlogs 	= Attlog::join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
    						->where('group.id', $groupid)
    						->where('finger_id', $fingerid)
    						->where('date', $tgl)
    						->orderBy('time', 'asc')->get();

    	$izins		= DB::table('izin')
      								  ->where('users_id', $user_id)
      								  ->where('group_id', $groupid)
      								  ->where('tgl_mulai_izin', '<=', $tgl)
  									    ->where('tgl_selesai_izin', '>=', $tgl)->get();

    	return view('adminpanel.kehadiran.log',  compact('attlogs', 'izins'));    	
    }
}
