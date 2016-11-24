<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Http\Requests;
use App\Kelompok;
use App\JadwalKhusus;

class JadwalKhususController extends Controller
{
    public function index()
    {
    	$data['jadwal_khusus'] = DB::table('jadwal_khusus')->get();
    	return view('adminpanel.jadwal_khusus.index', compact('data'));
    }

    public function create()
    {
    	$data['group']	= DB::table('group')->get();
    	foreach ($data['group'] as $key => $value) {
    		$data['group'][$key]->kelompok = DB::table('kelompok')->where('group_id', $value->id)->get();
    	}

    	return view('adminpanel.jadwal_khusus.create', compact('data'));
    }

    public function store(Request $request)
    {
    	// echo "<pre>";
    	// print_r($request->all());
    	// echo "</pre>"; 
    	$createdby						 =  Auth::user()->id;
    	$level							 =  Auth::user()->level;
    	$groupid 						 =  Auth::user()->group_id;
    	$keterangan		                 =  $request->keterangan;

    	$tglrentang						 =  $request->tglrentang;
    	$exp_tglrentang     			 =  explode("-", $tglrentang);
        $tgl_mulai		     			 =  str_replace( "/", "-", $exp_tglrentang[0] );
        $tgl_selesai		  			 =  str_replace( "/", "-", $exp_tglrentang[1] );


		$absen_istirahat                 =  $request->absen_istirahat;
		$absen_masuk_istirahat           =  $request->absen_masuk_istirahat;
		$absen_pulang                    =  $request->absen_pulang;

		$awal_masuk                      =  $request->awal_masuk;
		$akhir_masuk                     =  $request->akhir_masuk;
		$awal_masuk_jumat                =  $request->awal_masuk_jumat;
		$akhir_masuk_jumat               =  $request->akhir_masuk_jumat;

		if ( $request->has('absen_istirahat') ) {
			 $awal_istirahat               =  $request->awal_istirahat;
			 $akhir_istirahat              =  $request->akhir_istirahat;
			 $awal_istirahat_jumat         =  $request->awal_istirahat_jumat;
			 $akhir_istirahat_jumat        =  $request->akhir_istirahat_jumat;
		} else {
				 $awal_istirahat              =  '00:00:00';
				 $akhir_istirahat             =  '00:00:00';
				 $awal_istirahat_jumat        =  '00:00:00';
				 $akhir_istirahat_jumat       =  '00:00:00';
		}

		if ( $request->has('absen_masuk_istirahat') ) {
				 $awal_masuk_istirahat            =  $request->awal_masuk_istirahat;
				 $akhir_masuk_istirahat           =  $request->akhir_masuk_istirahat;
				 $awal_masuk_istirahat_jumat      =  $request->awal_masuk_istirahat_jumat;
				 $akhir_masuk_istirahat_jumat     =  $request->akhir_masuk_istirahat_jumat;
		} else {
				 $awal_masuk_istirahat            =  '00:00:00';
				 $akhir_masuk_istirahat           =  '00:00:00';
				 $awal_masuk_istirahat_jumat      =  '00:00:00';
				 $akhir_masuk_istirahat_jumat     =  '00:00:00';
		}

		if ( $request->has('absen_pulang') ) {
				 $awal_pulang                     =  $request->awal_pulang;
				 $akhir_pulang                    =  $request->akhir_pulang;
				 $awal_pulang_jumat               =  $request->awal_pulang_jumat;
				 $akhir_pulang_jumat              =  $request->akhir_pulang_jumat;
		} else {
				 $awal_pulang                     =  '00:00:00';
				 $akhir_pulang                    =  '00:00:00';
				 $awal_pulang_jumat               =  '00:00:00';
				 $akhir_pulang_jumat              =  '00:00:00';
		}

		//cek apakah ada inputan checkbox
		$request->has('absen_masuk') ? $absen_masuk = '1' : $absen_masuk = '0';
		$request->has('absen_masuk_istirahat') ? $absen_masuk_istirahat = '1' : $absen_masuk_istirahat = '0';
		$request->has('absen_istirahat') ? $absen_istirahat = '1' : $absen_istirahat = '0';
		$request->has('absen_pulang') ? $absen_pulang = '1' : $absen_pulang = '0';

		###### PROSES INSERT ########
		$id_jadwal	=  DB::table('jadwal_khusus')->insertGetId([
									'keterangan'               		  =>  $keterangan,
									'tanggal_mulai'					  =>  $tgl_mulai,
									'tanggal_selesai'				  =>  $tgl_selesai,
									'absen_istirahat'                 =>  $absen_istirahat,
									'absen_masuk_istirahat'           =>  $absen_masuk_istirahat,
									'absen_pulang'                    =>  $absen_pulang,
									'awal_masuk'                      =>  $awal_masuk,
									'akhir_masuk'                     =>  $akhir_masuk,
									'awal_masuk_jumat'                =>  $awal_masuk_jumat,
									'akhir_masuk_jumat'               =>  $akhir_masuk_jumat,
									'awal_istirahat'                  =>  $awal_istirahat,
									'akhir_istirahat'                 =>  $akhir_istirahat,
									'awal_istirahat_jumat'            =>  $awal_istirahat_jumat,
									'akhir_istirahat_jumat'           =>  $akhir_istirahat_jumat,
									'awal_masuk_istirahat'            =>  $awal_masuk_istirahat,
									'akhir_masuk_istirahat'           =>  $akhir_masuk_istirahat,
									'awal_masuk_istirahat_jumat'      =>  $awal_masuk_istirahat_jumat,
									'akhir_masuk_istirahat_jumat'     =>  $akhir_masuk_istirahat_jumat,
									'awal_pulang'                     =>  $awal_pulang,
									'akhir_pulang'                    =>  $akhir_pulang,
									'awal_pulang_jumat'               =>  $awal_pulang_jumat,
									'akhir_pulang_jumat'              =>  $akhir_pulang_jumat,
									'created_by'					  =>  $createdby,
									'level'							  =>  $level,
									'group_id'						  =>  $groupid
		]);

		foreach ($request->id_kelompok as $key => $value) 
		{
			DB::table('kelompok_jadwal_khusus')->insert([
					'kelompok_id'		=> $value,
					'jadwal_khusus_id'	=> $id_jadwal,
			]);
		}
		return redirect('/jadwal-khusus')
                        ->with('status_error', 'success')
                        ->with('pesan_error', 'Data berhasil ditambah.');
    }


    public function edit($id)
    {

    	$data['jadwal'] = DB::table('jadwal_khusus')->where('id', $id)->first();

    	$data['groups']	= DB::table('group')->get();
    	foreach ($data['groups'] as $key => $value) {
    		$data['groups'][$key]->kelompok = DB::table('kelompok')->where('group_id', $value->id)->get();
    	}

    	$data['kelompok_array'] = array();
    	$kelompok_jadwal_khusus = DB::table('kelompok_jadwal_khusus')->where('jadwal_khusus_id', $id)->get();
    	foreach ($kelompok_jadwal_khusus as $key => $value) {
				$data['kelompok_array'][$value->kelompok_id] = 1;    		
    	}

    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";
    	return view('adminpanel.jadwal_khusus.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
    	// echo "<pre>";
    	// print_r($request->all());
    	// echo "</pre>";
    	$createdby						 =  Auth::user()->id;
    	$level							 =  Auth::user()->level;
    	$groupid 						 =  Auth::user()->group_id;
    	$keterangan		                 =  $request->keterangan;

    	$tglrentang						 =  $request->tglrentang;
    	$exp_tglrentang     			 =  explode("-", $tglrentang);
        $tgl_mulai		     			 =  str_replace( "/", "-", $exp_tglrentang[0] );
        $tgl_selesai		  			 =  str_replace( "/", "-", $exp_tglrentang[1] );

		$absen_istirahat                 =  $request->absen_istirahat;
		$absen_masuk_istirahat           =  $request->absen_masuk_istirahat;
		$absen_pulang                    =  $request->absen_pulang;

		$awal_masuk                      =  $request->awal_masuk;
		$akhir_masuk                     =  $request->akhir_masuk;
		$awal_masuk_jumat                =  $request->awal_masuk_jumat;
		$akhir_masuk_jumat               =  $request->akhir_masuk_jumat;

		if ( $request->has('absen_istirahat') ) {
			 $awal_istirahat               =  $request->awal_istirahat;
			 $akhir_istirahat              =  $request->akhir_istirahat;
			 $awal_istirahat_jumat         =  $request->awal_istirahat_jumat;
			 $akhir_istirahat_jumat        =  $request->akhir_istirahat_jumat;
		} else {
				 $awal_istirahat              =  '00:00:00';
				 $akhir_istirahat             =  '00:00:00';
				 $awal_istirahat_jumat        =  '00:00:00';
				 $akhir_istirahat_jumat       =  '00:00:00';
		}

		if ( $request->has('absen_masuk_istirahat') ) {
				 $awal_masuk_istirahat            =  $request->awal_masuk_istirahat;
				 $akhir_masuk_istirahat           =  $request->akhir_masuk_istirahat;
				 $awal_masuk_istirahat_jumat      =  $request->awal_masuk_istirahat_jumat;
				 $akhir_masuk_istirahat_jumat     =  $request->akhir_masuk_istirahat_jumat;
		} else {
				 $awal_masuk_istirahat            =  '00:00:00';
				 $akhir_masuk_istirahat           =  '00:00:00';
				 $awal_masuk_istirahat_jumat      =  '00:00:00';
				 $akhir_masuk_istirahat_jumat     =  '00:00:00';
		}

		if ( $request->has('absen_pulang') ) {
				 $awal_pulang                     =  $request->awal_pulang;
				 $akhir_pulang                    =  $request->akhir_pulang;
				 $awal_pulang_jumat               =  $request->awal_pulang_jumat;
				 $akhir_pulang_jumat              =  $request->akhir_pulang_jumat;
		} else {
				 $awal_pulang                     =  '00:00:00';
				 $akhir_pulang                    =  '00:00:00';
				 $awal_pulang_jumat               =  '00:00:00';
				 $akhir_pulang_jumat              =  '00:00:00';
		}

		//cek apakah ada inputan checkbox
		$request->has('absen_masuk') ? $absen_masuk = '1' : $absen_masuk = '0';
		$request->has('absen_masuk_istirahat') ? $absen_masuk_istirahat = '1' : $absen_masuk_istirahat = '0';
		$request->has('absen_istirahat') ? $absen_istirahat = '1' : $absen_istirahat = '0';
		$request->has('absen_pulang') ? $absen_pulang = '1' : $absen_pulang = '0';

		###### PROSES UPDATE ########
		$update	=  DB::table('jadwal_khusus')->where('id', $id)->update([
									'keterangan'               		  =>  $keterangan,
									'tanggal_mulai'					  =>  $tgl_mulai,
									'tanggal_selesai'				  =>  $tgl_selesai,
									'absen_istirahat'                 =>  $absen_istirahat,
									'absen_masuk_istirahat'           =>  $absen_masuk_istirahat,
									'absen_pulang'                    =>  $absen_pulang,
									'awal_masuk'                      =>  $awal_masuk,
									'akhir_masuk'                     =>  $akhir_masuk,
									'awal_masuk_jumat'                =>  $awal_masuk_jumat,
									'akhir_masuk_jumat'               =>  $akhir_masuk_jumat,
									'awal_istirahat'                  =>  $awal_istirahat,
									'akhir_istirahat'                 =>  $akhir_istirahat,
									'awal_istirahat_jumat'            =>  $awal_istirahat_jumat,
									'akhir_istirahat_jumat'           =>  $akhir_istirahat_jumat,
									'awal_masuk_istirahat'            =>  $awal_masuk_istirahat,
									'akhir_masuk_istirahat'           =>  $akhir_masuk_istirahat,
									'awal_masuk_istirahat_jumat'      =>  $awal_masuk_istirahat_jumat,
									'akhir_masuk_istirahat_jumat'     =>  $akhir_masuk_istirahat_jumat,
									'awal_pulang'                     =>  $awal_pulang,
									'akhir_pulang'                    =>  $akhir_pulang,
									'awal_pulang_jumat'               =>  $awal_pulang_jumat,
									'akhir_pulang_jumat'              =>  $akhir_pulang_jumat,
									'created_by'					  =>  $createdby,
									'level'							  =>  $level,
									'group_id'						  =>  $groupid
		]);

		DB::table('kelompok_jadwal_khusus')->where('jadwal_khusus_id', $id)->delete();

		foreach ($request->kelompok_id as $key => $value) 
		{
			DB::table('kelompok_jadwal_khusus')->insert([
					'kelompok_id'		=> $value,
					'jadwal_khusus_id'	=> $id,
			]);
		}
		return redirect('/jadwal-khusus/update/'.$id)
                        ->with('status_error', 'success')
                        ->with('pesan_error', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
    	$jadwal_khusus = JadwalKhusus::findOrFail($id);
    	$jadwal_khusus->delete();

    	return redirect('/jadwal-khusus')
                        ->with('status_error', 'success')
                        ->with('pesan_error', 'Data berhasil dihapus.');
    }
}
