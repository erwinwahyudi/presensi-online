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
		$data['kelompok'] = DB::table('users')->where('group_id', $gid)
											  ->where('kelompok_id', $kid)->get();

		$data['nama_kelompok'] = DB::table('kelompok')->where('id', $kid)->first();
		$data['nama_group']    = DB::table('group')->where('id', $gid)->first();

		$data['bulan']		   = $bln;
		$data['tahun']		   = $thn;
  		
  		foreach ($data['kelompok'] as $key => $user) 
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

			$data['kelompok'][$key]->user_id             	= $user_id;
			$data['kelompok'][$key]->nama                	= $nama;
			$data['kelompok'][$key]->nip                 	= $nip;
			$data['kelompok'][$key]->masuk               	= $masuk;
			$data['kelompok'][$key]->tidak_masuk         	= $tidak_masuk;
			$data['kelompok'][$key]->terlambat           	= $terlambat;
			$data['kelompok'][$key]->ganti_terlambat     	= $ganti_terlambat;
			$data['kelompok'][$key]->psw                 	= $psw;
			$data['kelompok'][$key]->izin 			   	    = $izin;
			$data['kelompok'][$key]->potongan_terlambat  	= $potongan_terlambat;
			$data['kelompok'][$key]->potongan_psw        	= $potongan_psw;
			$data['kelompok'][$key]->total_potongan      	= $total_potongan;
			$data['kelompok'][$key]->total_jam_kerja	 	= $total_jam_kerja;
  		}	
	        
	    // echo "<pre>";
	    // print_r($data);
	    // echo "</pre>";

    	$pdf	= PDF::loadView('adminpanel.pdf.detail_group', compact('data') )
    					->setPaper('a4')->setOrientation('landscape');

    	return $pdf->stream();
    }

    public function print_detil_all($bln, $thn, $kid, $gid)
    {
    	$data['tahun']	= $thn;
    	$data['bulan']  = $bln;



    	//ambil data user dulu
    	$data['user_array']	= DB::table('users')->where('group_id', $gid)->where('kelompok_id', $kid)->get();

    	$data['nama_kelompok'] = DB::table('kelompok')->where('id', $kid)->first();
		$data['nama_group']    = DB::table('group')->where('id', $gid)->first();

    	//lalu buat perulangan user
    	foreach ($data['user_array'] as $no => $user) 
    	{
    		$user_id  = $user->id;
    		
    		$data['user_array'][$no]->masuk = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
		      ->where('group_id', $gid)
		      ->where('users_id', $user_id)
		      ->where('masuk', '1')->count();

			$data['user_array'][$no]->tidak_masuk = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('group_id', $gid)
			          ->where('users_id', $user_id)
			          ->where('masuk', '0')->count();

			$data['user_array'][$no]->terlambat = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('group_id', $gid)
			          ->where('users_id', $user_id)
			          ->where('terlambat', '1')->count();

			$data['user_array'][$no]->ganti_terlambat = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('group_id', $gid)
			          ->where('users_id', $user_id)
			          ->where('ganti_terlambat', '1')->count();

			$data['user_array'][$no]->psw = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('group_id', $gid)
			          ->where('users_id', $user_id)
			          ->where('psw', '1')->count();

			$data['user_array'][$no]->izin = Perhitungan::where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			          ->where('group_id', $gid)
			          ->where('users_id', $user_id)
			          ->where('izin', '1')
			          ->where('masuk', '0')->count();

			$potongan_terlambat  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_terlambat) as total_potongan_terlambat'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('group_id', $gid)
			                        ->where('users_id', $user_id)
			                        ->where('kategori_terlambat_id', '!=', '0')->first();
			$potongan_terlambat  = $potongan_terlambat->total_potongan_terlambat;


			$potongan_psw  = Perhitungan::select('potongan_terlambat', DB::raw('SUM(potongan_psw) as total_potongan_psw'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('group_id', $gid)
			                        ->where('users_id', $user_id)
			                        ->where('kategori_psw_id', '!=', '0')->first();
			$potongan_psw = $potongan_psw->total_potongan_psw;


			$total_potongan  = Perhitungan::select('total_potongan', DB::raw('SUM(total_potongan) as total_potongan'))
			                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
			                        ->where('group_id', $gid)
			                        ->where('users_id', $user_id)->first();
			$data['user_array'][$no]->total_potongan = $total_potongan->total_potongan;

			$jam_kerja  = Perhitungan::select('jam_kerja', DB::raw('SUM(jam_kerja) as jam_kerja'))
		                                        ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
		                                        ->where('group_id', $gid)
		                                        ->where('users_id', $user_id)->first();
			$jam_kerja = $jam_kerja->jam_kerja;

			$data['user_array'][$no]->total_jam_kerja	= Fn::total_jam_kerja($jam_kerja);	

			//ambil data perhitungan user
    		$data['user_array'][$no]->hari = DB::table('perhitungan')->where('users_id', $user_id)
    																  ->where('tanggal', 'LIKE', $thn.'-'.$bln.'%')
    																  ->orderBy('tanggal', 'ASC')->get();  
			//buat perulangan hari perhitungan user    
			foreach ($data['user_array'][$no]->hari as $key => $value) 
    		{	
    				$explode = explode('-', $value->tanggal);
    		 		$data['user_array'][$no]->hari[$key]->tgl = $explode[2];		
    		}

    		
    	}

    	// echo "<pre>";
	    // print_r($data);
	    // echo "</pre>";
	    $pdf	= PDF::loadView('adminpanel.pdf.detail_group_all', compact('data') )
    					->setPaper('a4')->setOrientation('potrait');

    	return $pdf->stream();
    }

    public function kartu($bln, $thn, $kid, $gid)
    {
    	$data['users']  = DB::table('users')->where('group_id', $gid)->where('kelompok_id', $kid)->get();

    	foreach ($data['users'] as $key => $user) {
    		$userid 	= $user->id;
    		$data['users'][$key]->hitung_izin	= DB::table('izin')->where('users_id', $userid)->where('tgl_mulai_izin', 'LIKE', $thn.'-'.$bln.'%')->count();
    		$data['users'][$key]->izin	= DB::table('izin')->where('users_id', $userid)->where('tgl_mulai_izin', 'LIKE', $thn.'-'.$bln.'%')->get();
    	}

    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";

    	$pdf 	= PDF::loadView('adminpanel.pdf.kartu', compact('data') )
    					->setPaper('a4')->setOrientation('potrait');
    	return $pdf->stream();
    }
}
