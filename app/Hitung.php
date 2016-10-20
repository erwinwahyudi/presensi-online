<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// untuk gunakan query builder
use DB;

class Hitung extends Model
{
    //cek libur
    public static function cek_libur($tgl) {
    	$libur = DB::table('libur')->where('tanggal', '=', $tgl)->count();
    	return $libur;
    }

    public static function cek_jadwal_khusus($tglmulai, $tglakhir) {

    }


    public static function hitung_unit_kerja($groupid, $tglstart, $tglend) {
			// Class cek_libur

			// Class cek_jadwal_khusus

			// $ambil_rentang_start
			// $ambil_rentang_end
			// $groupid
			// $kelompok

    		$users = DB::table('users')->where('group_id', '');



			// Foreach select userid from users id group dan kelompok and finger_id

			// 		//inisialisiasi data berdasarkan kelompok group userid
			// 		awal_masuk
			// 		akhir_masuk
			// 		awal_istirahat
			// 		akhir_istirahat
			// 		awal_masuk_istirahat
			// 		akhir_masuk_istirahat
			// 		awal_pulang
			// 		akhir_pulang

			// 		$kategori_terlambat1 = 0

			// 		foreach data_tanggal (dari $ambil_rentang_start sampai $ambil_rentang_akhir) where userid = user id
						
			// 			// masuk
			// 			$masuk = select from waktu attlog where tgl = data_tanggal time (batas_awal masuk kelompok sampai istirahat) where userid 
			// 				if $masuk = 0
			// 					tidak masuk
			// 					$data[0] 
			// 				else if $masuk > $batas_akhir_masuk(kelompok)
			// 					//terlambat
			// 					if( $masuk<=60)
			// 						$kategori_terlambat1 = 1
			// 			            Kategori terlambat 1
			// 			        else if ($masuk<=75) 
			// 			            Kategori terlambat 2
			// 			        else if ($masuk<=90) 
			// 			            Kategori terlambat 3
			// 			        else if ($masuk<=105) 
			// 			            Kategori terlambat 4
			// 			        else if ($masuk<=120) 
			// 			            Kategori terlambat 5
			// 			        else if ($masuk<=240) 
			// 			            Kategori terlambat 6
			// 			        else 
			// 			            no kategori';
			// 			         endif
			// 			    else
			// 			    	$masuk = waktu_absen_masuk        
			// 			    endif
			// 		    //masuk

			// 		    if data kelompok ada absen istirahat
			// 			    //istirahat
			// 			    $istirahat = select from waktu attlog where tgl= data_tgl time(batas_awal_istrirahat sampai batas_akhir_istirahat) where userid
			// 				    if $istirahat = 0
			// 				    	waktu_absen_istirahat = 0
			// 				   	else
			// 				   		waktu_absen_istirahat = $istirahat
			// 				   	end
			// 			   	//istirahat
			// 			else
			// 				$istirahat = 00:00:00
			// 			endif

			// 			if data kelompok ada absen masuk istirahat
			// 			   	//masuk istirahat
			// 			    $masuk_istirahat = select from waktu attlog where tgl= data_tgl time(batas_awal_masuk_istrirahat sampai batas_akhir_masuk_istirahat) where userid
			// 				    if $masuk_istirahat = 0
			// 				    	waktu_absen_masuk_istirahat = 0
			// 				   	else
			// 				   		waktu_absen_masuk_istirahat = $masuk_istirahat
			// 				   	end
			// 			   	//masuk istirahat
			// 			else
			// 				$istirahat = 00:00:00
			// 			endif

			// 			if data kelompok ada absen pulang
			// 			   	//pulang
			// 			    $pulang = select from waktu attlog where tgl= data_tgl time(batas_akhir_masuk_istrirahat sampai batas_awal_pulang) where userid
			// 				    if $pulang = 0
			// 				    	waktu_absen_pulang = 0
			// 				    else if $kategori_terlambat_1 = 1 && $pulang > $batas_pulang
			// 						if ($pulang - $batas_awal_pulang) >= ($masuk - $batas_waktu_masuk) 
			// 							$kategori_terlambat = 0
			// 						else
			// 							$kategori_terlambat = 1
			// 							$batas_awal_pulang = $waktu_absen_pulang
			// 						endif
			// 				    else if $pulang < $batas_awal_pulang
			// 					    	if( $pulang<=60) 
			// 					            Kategori psw 1
			// 					        else if ($pulang<=75) 
			// 					            Kategori psw 2
			// 					        else if ($pulang<=90) 
			// 					            Kategori psw 3
			// 					        else if ($pulang<=105) 
			// 					            Kategori psw 4
			// 					        else if ($pulang<=120) 
			// 					            Kategori psw 5
			// 					        else if ($pulang<=240) 
			// 					            Kategori psw 6
			// 					        else 
			// 					            waktu_absen_pulang = 0	
			// 					    endif
			// 					else
			// 				    	$pulang = waktu_absen_pulang
			// 					endif
			// 				//pulang
			// 			else
			// 				$pulang = 00:00:00
			// 			endif

			// 		endforeach
			// endforeach
    }

}
