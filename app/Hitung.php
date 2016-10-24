<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// untuk gunakan query builder
use DB;

class Hitung extends Model
{
    //cek libur
    public static function cek_libur($tgl) {
    	//dari daftar libur
    	$libur = DB::table('libur')->where('tanggal', '=', $tgl)->count();
    	
    	//cek sabtu minggu
        $weekDay = date('w', strtotime($tgl));
        if ( $weekDay == 0 || $weekDay == 6 || ($libur=='1') ) {
            $libur = '1';
        } else {
            $libur = '0';
        }
    	return $libur;
    }

    public static function cek_jadwal_khusus($tglmulai, $tglakhir) {

    }

    public static function selisih_menit($time1, $time2) {
    	$time = abs( strtotime($time1) - strtotime($time2) );
        $time = round($time / 60);
        return $time;
    }

    public static function cek_jumat($tgl) {
    	$date  =  date('w', strtotime($tgl));
    	if($date == 5) {
    		$jumat = '1';
    	} else {
    		$jumat = '0';
    	}
    	return $jumat;
    }


    public static function hitung_unit_kerja($groupid, $tglstart, $tglend) {
			// Class cek_libur

			// Class cek_jadwal_khusus

			// $ambil_rentang_start
			// $ambil_rentang_end
			// $groupid
			// $kelompok

    		$users = DB::table('users')->where('group_id', '=', $groupid)->get();
    		//1. Buat perulangan user berdasarkan
    		foreach ($users as $user) {
    			$user_id	 = $user->id;
    			$finger_id	 = $user->finger_id;
    			$kelompok_id = $user->kelompok_id;
    			$tglstart	 = $tglstart;
    			$tglend		 = $tglend;

    			// 1.1.inisiasi data awal yg nanti akan d create k db
    			$data_block	 = array(
    								'user_id'				=> $user_id,
    								'group_id'				=> $groupid,
					    			'hari'					=> 'NULL',
					    			'tanggal'				=> 'NULL',
					    			'masuk_pagi'	  		=> '00:00:00',
					    			'istirahat'	  			=> '00:00:00',
					    			'masuk_siang'  			=> '00:00:00',
					    			'pulang'		  		=> '00:00:00',
					    			'sesi1'  				=> '00:00:00',
					    			'sesi2'		  			=> '00:00:00',
					    			'masuk' 		  		=> '0',
					    			'terlambat'	  			=> '0',
					    			'kategori_terlambat_id'	=> '0',
					    			'kategori_psw_id'  		=> '0',
					    			'waktu_ganti_terlambat'	=> '00:00:00',
					    			'ganti_terlambat'		=> '0',
					    			'lembur'				=> '0',
					    			'total_lembur'			=> '0',
					    			'keterangan'			=> 'NULL',
						    	);

    			//1.2. Ambil data kelompok berdasarkan kelompok_id di userid
    			$kelompok  =  DB::table('kelompok')->where('id', $kelompok_id)->first();
    			
				$absen_istirahat                 =  $kelompok->absen_istirahat;  
		        $absen_masuk_istirahat           =  $kelompok->absen_masuk_istirahat;  
		        $absen_pulang                    =  $kelompok->absen_pulang;  
		        $hitung_lembur                   =  $kelompok->hitung_lembur;  
		        $awal_masuk                      =  $kelompok->awal_masuk;  
		        $akhir_masuk                     =  $kelompok->akhir_masuk;  
		        $awal_masuk_jumat                =  $kelompok->awal_masuk_jumat;  
		        $akhir_masuk_jumat               =  $kelompok->akhir_masuk_jumat;  
		        $awal_istirahat                  =  $kelompok->awal_istirahat;  
		        $akhir_istirahat                 =  $kelompok->akhir_istirahat;  
		        $awal_istirahat_jumat            =  $kelompok->awal_istirahat_jumat;  
		        $akhir_istirahat_jumat           =  $kelompok->akhir_istirahat_jumat;  
		        $awal_masuk_istirahat            =  $kelompok->awal_masuk_istirahat;  
		        $akhir_masuk_istirahat           =  $kelompok->akhir_masuk_istirahat;  
		        $awal_masuk_istirahat_jumat      =  $kelompok->awal_masuk_istirahat_jumat;  
		        $akhir_masuk_istirahat_jumat     =  $kelompok->akhir_masuk_istirahat_jumat;  
		        $awal_pulang                     =  $kelompok->awal_pulang;  
		        $akhir_pulang                    =  $kelompok->akhir_pulang;  
		        $awal_pulang_jumat               =  $kelompok->awal_pulang_jumat;  
		        $akhir_pulang_jumat              =  $kelompok->akhir_pulang_jumat;
			   

			    //1.3. Looping tanggal berdasarkan rentang yg disubmit dari form
    			$tanggals  =  DB::table('attlog')->whereBetween('date', [$tglstart, $tglend])
    											 ->where('finger_id', $finger_id)
    											 ->groupBy('date')
    											 ->orderBy('date', 'ASC')->get();

    			foreach ($tanggals as $tanggal) {
    				$tgl_attlog		= $tanggal->date;
    			 	$time_attlog	= $tanggal->time;

    			 	//1.3.1. Cek libur setiap hari/tgl
    				$cek_libur = Hitung::cek_libur($tgl_attlog);

    				//1.3.2. jika tidak libur, lakukan perhitungan terhadap tanggal
    				if($cek_libur=='0'){
    					$data_block['tanggal'] = $tgl_attlog;

    					//1.3.2.1. Cek jumat atau bukan
    					$cek_jumat = Hitung::cek_jumat($tgl_attlog);
    					if($cek_jumat=='0'){		    					    				

    							//1.3.2.1.1. Cek apakah di tanggal, user absen pagi
    							//rule  : - waktu paling terakhir absen yg akan dijadikan waktu masuk.
		    					//$masuk = select from waktu attlog where tgl = data_tanggal time (batas_awal masuk kelompok sampai istirahat) where userid
		    			 		$masuk = DB::table('attlog')->whereBetween('time', [$awal_masuk, $awal_istirahat])
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 		
		    			 			//1.3.2.1.2. Jika tidak ditemukan data, maka user tidak masuk, semua data block akan dikosongkan
		    			 		 	if ( empty($masuk) ) {
										$data_block['kategori_terlambat_id']	= '6';
										$data_block['kategori_psw_id']			= '6';
									//1.3.2.1.3 Jika masuk, maka lakukan perhitungan terhadap masing2 block data
									} else {
											$data_block['masuk']	= '1';
											#############   MASUK PAGI ####################		    			 		
											if ($masuk->time > $akhir_masuk) {
												//terlambat
												$data_block['masuk_pagi']	= $masuk->time;
												$hitung_selisih = Hitung::selisih_menit($masuk->time, $akhir_masuk);
												$data_block['terlambat'] = '1';
												if( $hitung_selisih<=60) {
													$data_block['kategori_terlambat_id'] = '1';
												}
										        else if ($hitung_selisih<=75) {
										            $data_block['kategori_terlambat_id'] = '2';
										        }
										        else if ($hitung_selisih<=90) {
										            $data_block['kategori_terlambat_id'] = '3';
										        }
										        else if ($hitung_selisih<=105) {
										            $data_block['kategori_terlambat_id'] = '4';
										        }
										        else if ($hitung_selisih<=120) {
										            $data_block['kategori_terlambat_id'] = '5';
										        }
										        else if ($hitung_selisih<=240) {
										            $data_block['kategori_terlambat_id'] = '6';
										        }
										    } else {
										    	$data_block['masuk_pagi']				 = $masuk->time;
										    	$data_block['terlambat']				 = '0';
										    	$data_block['kategori_terlambat_id']	 = '0';        
										    }
										    #############   MASUK PAGI ####################


										    #############  ISTIRAHAT ####################
											//cek dulu apa ada absen istirahat di kelompok
											if($absen_istirahat=='1') {
												$istirahat = DB::table('attlog')->whereBetween('time', [$awal_istirahat, $akhir_istirahat])
							    			 									->where('finger_id', $finger_id)
							    			 									->where('date', $tgl_attlog)
							    			 									->orderBy('time', 'desc')->first();
						    			 		
						    			 		
						    			 		 	// $waktu_istirahat 			  = $istirahat->time;	
						    			 		 	if (empty($istirahat)) {
														$data_block['istirahat']  = '00:00:00';
													} else {
														$data_block['istirahat']	  = $istirahat->time; 			    			 		 	
													}
											} else {
												$data_block['istirahat']  = '00:00:00';
											}
											#############  ISTIRAHAT ####################


											#############  MASUK ISTIRAHAT ####################
											//cek dulu apa ada absen istirahat di kelompok
											if($absen_masuk_istirahat=='1') {
												$masuk_siang = DB::table('attlog')->whereBetween('time', [$awal_masuk_istirahat, $akhir_masuk_istirahat])
							    			 									->where('finger_id', $finger_id)
							    			 									->where('date', $tgl_attlog)
							    			 									->orderBy('time', 'desc')->first();
						    			 		
						    			 		
						    			 		 	// $waktu_istirahat 			  = $istirahat->time;	
						    			 		 	if (empty($masuk_siang)) {
														$data_block['masuk_siang']  = '00:00:00';
													} else {
														$data_block['masuk_siang']	  = $masuk_siang->time; 			    			 		 	
													}
											} else {
												$data_block['masuk_siang']  = '00:00:00';
											}
											#############  MASUK ISTIRAHAT ####################


											#############  PULANG ####################
											if($absen_pulang=='1') {
												//cek apakah kategori_terlambat_id = 1
												if($data_block['kategori_terlambat_id'] == '1') {
													//set waktu pulang user = waktu kelompok pulang + terlambat
													$awal_pulang = date('H:i:s', strtotime('+'.$hitung_selisih.' minute', strtotime($awal_pulang)) );
													echo '<br>awal pulang : '.$awal_pulang;
												}

												$pulang = DB::table('attlog')->whereBetween('time', [$akhir_masuk_istirahat, $akhir_pulang])
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 							if (empty($pulang)) {
		    			 								$data_block['pulang'] 			= '00:00:00';
		    			 								$data_block['kategori_psw_id']	= '6';
		    			 							} elseif($pulang->time < $awal_pulang) {
														//psw
														$data_block['pulang']	= $pulang->time;
														$hitung_selisih_pulang = Hitung::selisih_menit($awal_pulang, $pulang->time);
														if( $hitung_selisih_pulang<=60) {
															$data_block['kategori_psw_id'] = '1';
														}
												        else if ($hitung_selisih_pulang<=75) {
												            $data_block['kategori_psw_id'] = '2';
												        }
												        else if ($hitung_selisih_pulang<=90) {
												            $data_block['kategori_psw_id'] = '3';
												        }
												        else if ($hitung_selisih_pulang<=105) {
												            $data_block['kategori_psw_id'] = '4';
												        }
												        else if ($hitung_selisih_pulang<=120) {
												            $data_block['kategori_psw_id'] = '5';
												        }
												        else if ($hitung_selisih_pulang<=240) {
												            $data_block['kategori_psw_id'] = '6';
												        }
												    } else {
												    	$data_block['pulang	']				 	 = $pulang->time;
												    	$data_block['terlambat']				 = '0';
												    	$data_block['kategori_terlambat_id']	 = '0';        
												    }
											} else {
												$data_block['pulang']			= '00:00:00';
											}
											#############  PULANG ####################
									}    								

								

								
								print_r($data_block);
						} else {
								echo 'jumat';
								#############   MASUK PAGI ####################
		    			 		//$masuk = select from waktu attlog where tgl = data_tanggal time (batas_awal masuk kelompok sampai istirahat) where userid
		    			 		$masuk = DB::table('attlog')->whereBetween('time', [$awal_masuk_jumat, $awal_istirahat_jumat])
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 		
		    			 		
		    			 		 	$waktu_masuk 				= $masuk->time;	
		    			 		 	$data_block['masuk_pagi']	= $waktu_masuk; 	
		    			 		 	if ($waktu_masuk=='0') {
										$data_block['masuk'] = '0';
									} elseif ($waktu_masuk > $akhir_masuk) {
										//terlambat
										$hitung_selisih = Hitung::selisih_menit($waktu_masuk, $akhir_masuk);
										$data_block['terlambat'] = '1';
										if( $hitung_selisih<=60) {
											$data_block['kategori_terlambat_id'] = '1';
										}
								        else if ($hitung_selisih<=75) {
								            $data_block['kategori_terlambat_id'] = '2';
								        }
								        else if ($hitung_selisih<=90) {
								            $data_block['kategori_terlambat_id'] = '3';
								        }
								        else if ($hitung_selisih<=105) {
								            $data_block['kategori_terlambat_id'] = '4';
								        }
								        else if ($hitung_selisih<=120) {
								            $data_block['kategori_terlambat_id'] = '5';
								        }
								        else if ($hitung_selisih<=240) {
								            $data_block['kategori_terlambat_id'] = '6';
								        }
								    } else {
								    	$data_block['terlambat']				 = '0';
								    	$data_block['kategori_terlambat_id']	 = '0';        
								    }   
								#############   MASUK PAGI ####################_jumat
						}
    				}
    			}
    		}
    }


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

    		//			if tidak absen masuk, kosongkan semua data block

			// 		endforeach
			// endforeach    

}
