<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use PDF;

// ambil model
use App\Perhitungan;
use App\Fn;
use App\User;
use App\Attlog;

class PdfController extends Controller
{
    public function print_group($bln, $thn, $kid, $gid)
    {
		$data['kelompok_array'] = DB::table('users')->where('group_id', $gid)
													->where('kelompok_id', $kid)->get();
  		
  		foreach ($data['kelompok_array'] as $key => $user) 
  		{
  					          		
			$user_id  = $user->id;          
			$nama     = $user->nama;
			$nip      = $user->nip;  

			$masuk = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			      ->where('users_id', $user_id)
			      ->where('masuk', '1')->count();

			$tidak_masuk = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('users_id', $user_id)
			          ->where('masuk', '0')->count();

			$terlambat = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('users_id', $user_id)
			          ->where('terlambat', '1')->count();

			$ganti_terlambat = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('users_id', $user_id)
			          ->where('ganti_terlambat', '1')->count();

			$psw = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('users_id', $user_id)
			          ->where('psw', '1')->count();

			$izin = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('users_id', $user_id)
			          ->where('izin', '1')
			          ->where('masuk', '0')->count();

			$potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('users_id', $user_id)
			                        ->where('kategori_terlambat_id', '!=', '0')->first();
			$potongan_terlambat = $potongan_terlambat->total_potongan_terlambat;


			$potongan_psw  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_psw) as total_potongan_psw'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('users_id', $user_id)
			                        ->where('kategori_psw_id', '!=', '0')->first();
			$potongan_psw = $potongan_psw->total_potongan_psw;


			$total_potongan  = Perhitungan::select('total_potongan', DB::raw('SUM(total_potongan) as total_potongan'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('users_id', $user_id)->first();
			$total_potongan = $total_potongan->total_potongan;

			$jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('users_id', $user_id)->first();
			$jam_kerja = $jam_kerja->jam_kerja;

			$total_jam_kerja	= Fn::total_jam_kerja($jam_kerja);

			$data['kelompok_array'][$key]->user_id             	= $user_id;
			$data['kelompok_array'][$key]->nama                	= $nama;
			$data['kelompok_array'][$key]->nip                 	= $nip;
			$data['kelompok_array'][$key]->masuk               	= $masuk;
			$data['kelompok_array'][$key]->tidak_masuk         	= $tidak_masuk;
			$data['kelompok_array'][$key]->terlambat           	= $terlambat;
			$data['kelompok_array'][$key]->ganti_terlambat     	= $ganti_terlambat;
			$data['kelompok_array'][$key]->psw                 	= $psw;
			$data['kelompok_array'][$key]->izin 			   	= $izin;
			$data['kelompok_array'][$key]->potongan_terlambat  	= $potongan_terlambat;
			$data['kelompok_array'][$key]->potongan_psw        	= $potongan_psw;
			$data['kelompok_array'][$key]->total_potongan      	= $total_potongan;
			$data['kelompok_array'][$key]->total_jam_kerja	 	= $total_jam_kerja;
  		}	
	        
	    echo "<pre>";
	    print_r($data);
	    echo "</pre>";

    	// $pdf	= PDF::loadView('adminpanel.rekap.pdf', compact('users') )
    	// 				->setPaper('a4')->setOrientation('landscape');

    	// return $pdf->stream();
    }

    public function print_detil($bln, $thn, $kid, $gid)
    {

    }
}
