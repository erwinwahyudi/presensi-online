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

class RekapController extends Controller
{
    public function index() 
    {
      	$data['users']   = '0';
      	$data['bulan']   = '0';
      	$data['tahun']   = '0';
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
	          //buat perulangan user
	          $users = DB::table('users')->where('group_id', '=', $groupid)->get();
	          foreach ($users as $key => $user) 
	          {
	              $user_id  = $user->id;          
	              $nama     = $user->nama;
	              $nip      = $user->nip;  

	              $masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                      ->where('group_id', $groupid)
	                      ->where('users_id', $user_id)
	                      ->where('masuk', '1')->count();

	              $tidak_masuk = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $user_id)
	                          ->where('masuk', '0')->count();

	              $terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $user_id)
	                          ->where('terlambat', '1')->count();

	              $ganti_terlambat = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $user_id)
	                          ->where('ganti_terlambat', '1')->count();
	              
	              $psw = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                          ->where('group_id', $groupid)
	                          ->where('users_id', $user_id)
	                          ->where('psw', '1')->count();

	              $potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
	                                        ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
	                                        ->where('group_id', $groupid)
	                                        ->where('users_id', $user_id)
	                                        ->where('kategori_terlambat_id', '!=', '0')->first();
	              $potongan_terlambat = $potongan_terlambat->total_potongan_terlambat;


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
	              $total_potongan = $total_potongan->total_potongan;

	              $users[$key]->user_id             = $user_id;
	              $users[$key]->nama                = $nama;
	              $users[$key]->nip                 = $nip;
	              $users[$key]->masuk               = $masuk;
	              $users[$key]->tidak_masuk         = $tidak_masuk;
	              $users[$key]->terlambat           = $terlambat;
	              $users[$key]->ganti_terlambat     = $ganti_terlambat;
	              $users[$key]->psw                 = $psw;
	              $users[$key]->potongan_terlambat  = $potongan_terlambat;
	              $users[$key]->potongan_psw        = $potongan_psw;
	              $users[$key]->total_potongan      = $total_potongan;
	          } 
	          $data['users'] = $users;
	      } else {
	          $data['users'] = '0';
	      }

	      $data['bulan']	 = $bulan;
	      $data['tahun']	 = $tahun;

    	return view('adminpanel.rekap.index', compact('data'));
    }


    public function rekap_user($bln, $thn, $uid)
    {
    	$groupid    = Auth::user()->group_id;
    	$perhitungans = Perhitungan::where('users_id', $uid)
    								->where('group_id', $groupid)
    								->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
    								->orderBy('tanggal', 'asc')->get();

    	$user = User::where('id', $uid)
					 ->where('group_id', $groupid)->first();

    	return view('adminpanel.rekap.detil_user', compact('perhitungans', 'user'));
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
    								   ->where('group_id', $groupid)->get();

    	return view('adminpanel.rekap.log', compact('attlogs', 'user', 'izins'));    	
    }
}
