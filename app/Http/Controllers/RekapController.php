<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;
use PDF;

// ambil model
use App\Perhitungan;
use App\Fn;
use App\User;
use App\Attlog;

class RekapController extends Controller
{
    public function index() 
    {
      	$data['kelompok_array']  = '0';
      	
    	return view('adminpanel.rekap.index', compact('data'));
    }

  

    public function rekap_group(Request $request) 
    {
    	$bulantahun = $request->bulantahun;
    	$fn_bt = Fn::pisah_bulantahun($bulantahun);
            $bulan    = $fn_bt['bulan'];
            $tahun    = $fn_bt['tahun'];
            
    	$groupid    = Auth::user()->group_id;       

	      if($request->has('bulantahun')) 
	      {
	          //buat perulangan kelompok
	          $data['kelompok_array'] = DB::table('kelompok')->where('group_id', $groupid)->get();
	          foreach ($data['kelompok_array'] as $index => $kelompok) 
	          {
	          		$data['kelompok_array'][$index]->user = DB::table('users')->where('kelompok_id', $kelompok->id)->get();
	          		
	          		foreach ($data['kelompok_array'][$index]->user as $key => $value) 
	          		{
	          					          		
						$user_id  = $value->id;          
						$nama     = $value->nama;
						$nip      = $value->nip;  

						$masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						      ->where('users_id', $user_id)
						      ->where('masuk', '1')->count();

						$tidak_masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						          ->where('users_id', $user_id)
						          ->where('masuk', '0')->count();

						$terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						          ->where('users_id', $user_id)
						          ->where('terlambat', '1')->count();

						$ganti_terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						          ->where('users_id', $user_id)
						          ->where('ganti_terlambat', '1')->count();

						$psw = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						          ->where('users_id', $user_id)
						          ->where('psw', '1')->count();

						$izin = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						          ->where('users_id', $user_id)
						          ->where('izin', '1')
						          ->where('masuk', '0')->count();

						$potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						                        ->where('users_id', $user_id)
						                        ->where('kategori_terlambat_id', '!=', '0')->first();
						$potongan_terlambat = $potongan_terlambat->total_potongan_terlambat;


						$potongan_psw  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_psw) as total_potongan_psw'))
						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						                        ->where('users_id', $user_id)
						                        ->where('kategori_psw_id', '!=', '0')->first();
						$potongan_psw = $potongan_psw->total_potongan_psw;


						$total_potongan  = Perhitungan::select('total_potongan', DB::raw('SUM(total_potongan) as total_potongan'))
						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						                        ->where('users_id', $user_id)->first();
						$total_potongan = $total_potongan->total_potongan;

						$jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
						                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
						                        ->where('users_id', $user_id)->first();
						$jam_kerja = $jam_kerja->jam_kerja;

						$total_jam_kerja	= Fn::total_jam_kerja($jam_kerja);

						$data['kelompok_array'][$index]->user[$key]->user_id             = $user_id;
						$data['kelompok_array'][$index]->user[$key]->nama                = $nama;
						$data['kelompok_array'][$index]->user[$key]->nip                 = $nip;
						$data['kelompok_array'][$index]->user[$key]->masuk               = $masuk;
						$data['kelompok_array'][$index]->user[$key]->tidak_masuk         = $tidak_masuk;
						$data['kelompok_array'][$index]->user[$key]->terlambat           = $terlambat;
						$data['kelompok_array'][$index]->user[$key]->ganti_terlambat     = $ganti_terlambat;
						$data['kelompok_array'][$index]->user[$key]->psw                 = $psw;
						$data['kelompok_array'][$index]->user[$key]->izin 				 = $izin;
						$data['kelompok_array'][$index]->user[$key]->potongan_terlambat  = $potongan_terlambat;
						$data['kelompok_array'][$index]->user[$key]->potongan_psw        = $potongan_psw;
						$data['kelompok_array'][$index]->user[$key]->total_potongan      = $total_potongan;
						$data['kelompok_array'][$index]->user[$key]->total_jam_kerja	 = $total_jam_kerja;
	          		}
	          } 
	      } else {
	          $data['kelompok_array'] = '0';
	      }

	      $data['bulan']	 = $bulan;
	      $data['tahun']	 = $tahun;

	      // echo "<pre>";
	      // print_r($data);
	      // echo "</pre>";

    	return view('adminpanel.rekap.index', compact('data'));
    }


    public function rekap_user($bln, $thn, $uid)
    {
    	$groupid    = Auth::user()->group_id;
    	$user_id    = $uid;
    	$tahun		= $thn;
    	$bulan 		= $bln;

    	$data['perhitungans'] = Perhitungan::where('users_id', $uid)
    								->where('group_id', $groupid)
    								->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
    								->orderBy('tanggal', 'asc')->get();

    	$data['user'] = User::where('id', $uid)
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

    	return view('adminpanel.rekap.detil_user', compact('data'));
    }

    public function log($uid, $tgl)
    {
    	$groupid    = Auth::user()->group_id;
    	$user 		= User::where('id', $uid)
    					  ->where('group_id', $groupid)->first();

    	$fingerid   = $user->finger_id;

    	$attlogs 	= Attlog::join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
    						->where('group.id', $groupid)
    						->where('finger_id', $fingerid)
    						->where('date', $tgl)
    						->orderBy('time', 'asc')->get();

    	$izins		= DB::table('izin')->join('kategori_izin', 'izin.kode_izin', '=', 'kategori_izin.kode_izin')
    								   ->where('users_id', $uid)
    								   ->where('group_id', $groupid)
    								   ->where('tgl_mulai_izin', '<=', $tgl)
									   ->where('tgl_selesai_izin', '>=', $tgl)->get();

    	return view('adminpanel.rekap.log', compact('attlogs', 'user', 'izins'));    	
    }

    				
}
