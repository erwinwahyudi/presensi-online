<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;

// ambil model
use App\Perhitungan;
use App\Fn;

class RekapController extends Controller
{
    public function index() {
    	return view('adminpanel.rekap.index');
    }

    public function rekap_group(Request $request) {
    	$bulantahun = $request->bulantahun;
    	$fn_bt = Fn::pisah_bulantahun($bulantahun);
            $bulan    = $fn_bt['bulan'];
            $tahun    = $fn_bt['tahun'];
            
    	$userid     = Auth::user()->id;
        $groupid    = Auth::user()->group_id;

        //buat perulangan user
       	$users = DB::table('users')->where('group_id', '=', $groupid)->get();

       	echo "<pre>";
       	foreach ($users as $user) {
       		$data['user_id']	= $user->id;       	 	
       		$data['nama']		= $user->nama;
       		$data['nip']		= $user->nip;

       	 	$data['masuk'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
    						    ->where('group_id', $groupid)
    						    ->where('users_id', $data['user_id'])
    						    ->where('masuk', '1')->count();

    		$data['tidak_masuk'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
    						    ->where('group_id', $groupid)
    						    ->where('users_id', $data['user_id'])
    						    ->where('masuk', '0')->count();

    		$data['terlambat'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
    						    ->where('group_id', $groupid)
    						    ->where('users_id', $data['user_id'])
    						    ->where('terlambat', '1')->count();
  			
    		$data['psw'] = Perhitungan::where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
    						    ->where('group_id', $groupid)
    						    ->where('users_id', $data['user_id'])
    						    ->where('psw', '1')->count();

    		$potongan  = Perhitungan::join('kategori_terlambat', 'perhitungan.kategori_terlambat_id', '=', 'kategori_terlambat.id')
    							->select('pengurangan', DB::raw('SUM(pengurangan) as total'))
    						    ->where('tanggal', 'LIKE', $tahun.'-'.$bulan.'%')
    							->where('group_id', $groupid)
    						    ->where('users_id', $data['user_id'])
    						    ->where('kategori_terlambat_id', '!=', '0')->get();

    		foreach ($potongans as $potongan) {
    			$data['potongan'] = $potongan->total;
    		}

 		print_r($data);
       	} 

       	echo "<pre>";

    	

    	

    	// return view('adminpanel.rekap.index');
    }
}
