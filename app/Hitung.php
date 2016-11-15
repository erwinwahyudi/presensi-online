<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// untuk gunakan query builder
use DB;
use DateTime;
use DateInterval;
use DatePeriod;

class Hitung extends Model
{
   
    public static function hitung_unit_kerja($groupid, $tglstart, $tglend) {
			
			$users = DB::table('users')->where('group_id', $groupid)
									   ->where('level', 'anggota')->get();
    		//1. Buat perulangan user berdasarkan
    		foreach ($users as $user) {

    			// 1.1.inisiasi data awal yg nanti akan d create k db
    			$nama 		 = $user->nama;
    			$user_id	 = $user->id;
    			$finger_id	 = $user->finger_id;
    			$kelompok_id = $user->kelompok_id;
    			$tglstart	 = $tglstart;
    			$tglend		 = $tglend;
    			
    			

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
    			// $tanggals  =  DB::table('attlog')->whereBetween('date', [$tglstart, $tglend])
    			// 								 ->where('finger_id', $finger_id)
    			// 								 ->groupBy('date')
    			// 								 ->orderBy('date', 'ASC')->get();

		        //1.3. Looping tanggal berdasarkan rentang yg disubmit dari form
    			$tanggals = Hitung::rentang_tanggal($tglstart, $tglend);

    			foreach ($tanggals as $tanggal) {
    				$data_block	 = array(
    								// 'nama'					=> $nama,
    								'users_id'				=> $user_id,
    								'group_id'				=> $groupid,
					    			'hari'					=> '',
					    			'tanggal'				=> '',
					    			'masuk_pagi'	  		=> '00:00:00',
					    			'istirahat'	  			=> '00:00:00',
					    			'masuk_siang'  			=> '00:00:00',
					    			'pulang'		  		=> '00:00:00',
					    			'sesi1'  				=> '00:00:00',
					    			'sesi2'		  			=> '00:00:00',
					    			'masuk' 		  		=> '0',
					    			'terlambat'	  			=> '0',
					    			'ganti_terlambat'	  	=> '0',
					    			'psw'					=> '0',
					    			'kategori_terlambat_id'	=> '0',
					    			'kategori_psw_id'  		=> '0',
					    			'lembur'				=> '0',
					    			'izin'					=> '0',
					    			'total_lembur'			=> '0',
					    			'jam_kerja'				=> '0',
					    			'potongan_terlambat'	=> '0',
					    			'potongan_psw'			=> '0',
					    			'total_potongan'		=> '0',
					    			'keterangan'			=> '',
						    	);


    				$tgl_attlog			= $tanggal->format("Y-m-d");

    			 	//buat nama hari
    			 	$hari 				= Hitung::nama_hari($tgl_attlog);
    			 	$data_block['hari'] = $hari;

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
		    			 			$fullday = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
								    						->whereBetween('time', [$awal_masuk, $akhir_pulang])
								    						->where('group.id', $groupid)
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 		
		    			 			//1.3.2.1.2. Jika tidak ditemukan data absen dalam 1hari maka user tidak masuk, semua data block akan dikosongkan
		    			 		 	if ( empty($fullday) ) {
		    			 		 		$data = Hitung::get_data_tidak_masuk($user_id, $groupid, $tgl_attlog);

		    			 		 		$data_block['jam_kerja']		= $data->jam_kerja;
										$data_block['masuk']			= $data->masuk;				
		    			 		 		$data_block['keterangan'] 		= $data->keterangan;
		    			 		 		$data_block['total_potongan']	= $data->total_potongan;
		    			 		 		$data_block['izin']				= $data->izin;
									//1.3.2.1.3 Jika masuk, maka lakukan perhitungan terhadap masing2 block data
									} else {
											$masuk = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
								    						->whereBetween('time', [$awal_masuk, $awal_istirahat])
								    						->where('group.id', $groupid)
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 					//cek apakah user absen pagi
		    			 					if( empty($masuk) ) {
		    			 						//set default awal masuk jadi jam 9
		    			 						$waktu_masuk 	 			=  '09:00:00';
		    			 						$data_block['keterangan']	=  'Tidak Absen Pagi';
		    			 					} else {
		    			 						$waktu_masuk	 			=  $masuk->time;
		    			 					}

											$data_block['masuk']	= '1';
											#############   MASUK PAGI ####################		    			 		
											if ($waktu_masuk > $akhir_masuk) {
												//terlambat
												$data_block['masuk_pagi']	= $waktu_masuk;
												$hitung_selisih = Hitung::selisih_menit($waktu_masuk, $akhir_masuk);
												
												$data_block['terlambat'] = '1';
												if( $hitung_selisih<=60) {
													$data_block['kategori_terlambat_id'] = '1';
													$data_block['potongan_terlambat']	 = '0.25';
												}
										        else if ($hitung_selisih<=75) {
										            $data_block['kategori_terlambat_id'] = '2';
										            $data_block['potongan_terlambat']	 = '0.5';
										        }
										        else if ($hitung_selisih<=90) {
										            $data_block['kategori_terlambat_id'] = '3';
										            $data_block['potongan_terlambat']	 = '1';
										        }
										        else if ($hitung_selisih<=105) {
										            $data_block['kategori_terlambat_id'] = '4';
										            $data_block['potongan_terlambat']	 = '1.5';
										        }
										        else if ($hitung_selisih<=120) {
										            $data_block['kategori_terlambat_id'] = '5';
										            $data_block['potongan_terlambat']	 = '2';
										        }
										        else if ($hitung_selisih<=240) {
										            $data_block['kategori_terlambat_id'] = '6';
										            $data_block['potongan_terlambat']	 = '2.5';
										        }
										    } else {
										    	$data_block['masuk_pagi']				 = $waktu_masuk;
										    	$data_block['terlambat']				 = '0';
										    	$data_block['kategori_terlambat_id']	 = '0';        
										    }
										    #############   MASUK PAGI ####################


										    #############  ISTIRAHAT ####################
											//cek dulu apa ada absen istirahat di kelompok
											if($absen_istirahat=='1') {
												$istirahat = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
													    						->whereBetween('time', [$awal_istirahat, $akhir_istirahat])
													    						->where('group.id', $groupid)
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
												$masuk_siang = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
													    						->whereBetween('time', [$awal_masuk_istirahat, $akhir_masuk_istirahat])
													    						->where('group.id', $groupid)
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
												// //cek apakah kategori_terlambat_id = 1
												// if($data_block['kategori_terlambat_id'] == '1') {
												// 	//set waktu pulang user = waktu kelompok pulang + terlambat
												// 	// $awal_pulang = date('H:i:s', strtotime('+'.$hitung_selisih.' minute', strtotime($awal_pulang)) );
												// 	// echo '<br>awal pulang : '.$awal_pulang;
												// }

												$pulang = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
												    						->whereBetween('time', [$akhir_masuk_istirahat, $akhir_pulang])
												    						->where('group.id', $groupid)
						    			 									->where('finger_id', $finger_id)
						    			 									->where('date', $tgl_attlog)
						    			 									->orderBy('time', 'desc')->first();

		    			 							if (empty($pulang)) {
		    			 								$data_block['pulang'] 			= '00:00:00';
		    			 								$data_block['keterangan']		= 'Tidak absen pulang';
		    			 								$data_block['kategori_psw_id']	= '6';
		    			 							} elseif($pulang->time < $awal_pulang) {
														//psw
														$data_block['psw'] = '1';
												
														$data_block['pulang']	= $pulang->time;
														$hitung_selisih_pulang = Hitung::selisih_menit($awal_pulang, $pulang->time);
														if( $hitung_selisih_pulang<=60) {
															$data_block['kategori_psw_id'] = '1';
															$data_block['potongan_psw']	   = '0.25';
														}
												        else if ($hitung_selisih_pulang<=75) {
												            $data_block['kategori_psw_id'] = '2';
												            $data_block['potongan_psw']	   = '0.5';
												        }
												        else if ($hitung_selisih_pulang<=90) {
												            $data_block['kategori_psw_id'] = '3';
												            $data_block['potongan_psw']	   = '1';
												        }
												        else if ($hitung_selisih_pulang<=105) {
												            $data_block['kategori_psw_id'] = '4';
												            $data_block['potongan_psw']	   = '1.5';
												        }
												        else if ($hitung_selisih_pulang<=120) {
												            $data_block['kategori_psw_id'] = '5';
												            $data_block['potongan_psw']	   = '2';
												        }
												        else if ($hitung_selisih_pulang<=240) {
												            $data_block['kategori_psw_id'] = '6';
												            $data_block['potongan_psw']	   = '2.5';
												        }
												    } else {
												    	//cek apakah kategori_terlambat_id = 1
														if($data_block['terlambat']=='1' && $data_block['kategori_terlambat_id'] == '1') {
															$ganti_pulang = date('H:i:s', strtotime('+'.$hitung_selisih.' minute', strtotime($awal_pulang)) );
															//jika user mengganti keterlambatan 1, set terlambat jadi 0
															if($pulang->time > $ganti_pulang){
																$data_block['kategori_terlambat_id']	= '1';
																$data_block['potongan_terlambat']	 	= '0';
																$data_block['potongan_psw']	 			= '0';
																$data_block['ganti_terlambat']			= '1';
															} 														
														}
												    	$data_block['pulang']				 	 = $pulang->time;     
												    }
											} else {
												$data_block['pulang']			= '00:00:00';
											}
											#############  PULANG ####################

											############### HITUNG TOTAL JAM KERJA 1 HARI #################################
											if($absen_pulang == 1) {
												//jika user absen pulang
												if(!empty($pulang->time)) {
													if( $data_block['psw'] == 0 && $data_block['terlambat'] == 0 ) {
														$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang,  $akhir_masuk) - 60;
													} elseif( $data_block['psw'] == 1 && $data_block['terlambat'] == 0 ) {
														$data_block['jam_kerja']	=  Hitung::selisih_menit($pulang->time, $akhir_masuk) - 60;
													} elseif( $data_block['psw'] == 0 && $data_block['terlambat'] == 1 ) {
														if( $data_block['kategori_terlambat_id'] == 1 && $data_block['ganti_terlambat'] == 1 ) {
															$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang, $akhir_masuk) - 60;
														} else {
															$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang, $waktu_masuk) - 60;
														}
													}
												}
											}
											############### HITUNG TOTAL JAM KERJA 1 HARI #################################

											//hitung total potongan
											$data_block['total_potongan'] 		= $data_block['potongan_terlambat'] + $data_block['potongan_psw'];
									}    			
								
						//1.3.2.2 Jika jumat
						} else {
								//1.3.2.2.1. Cek apakah di tanggal, user absen pagi
    							//rule  : - waktu paling terakhir absen yg akan dijadikan waktu masuk.
		    					//$masuk = select from waktu attlog where tgl = data_tanggal time (batas_awal masuk kelompok sampai istirahat) where userid
		    			 		$fullday = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
								    						->whereBetween('time', [$awal_masuk_jumat, $akhir_pulang_jumat])
								    						->where('group.id', $groupid)
		    			 									->where('finger_id', $finger_id)
		    			 									->where('date', $tgl_attlog)
		    			 									->orderBy('time', 'desc')->first();
		    			 		
		    			 			//1.3.2.1.2. Jika tidak ditemukan data absen dalam 1hari maka user tidak masuk, semua data block akan dikosongkan
		    			 		 	if ( empty($fullday) ) {
		    			 		 		$data = Hitung::get_data_tidak_masuk($user_id, $groupid, $tgl_attlog);

		    			 		 		$data_block['jam_kerja']		= $data->jam_kerja;
										$data_block['masuk']			= $data->masuk;			
		    			 		 		$data_block['keterangan'] 		= $data->keterangan;
		    			 		 		$data_block['total_potongan']	= $data->total_potongan;
		    			 		 		$data_block['izin']				= $data->izin;
									//1.3.2.2.3 Jika masuk, maka lakukan perhitungan terhadap masing2 block data
									} else {
											$masuk = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
											    						->whereBetween('time', [$awal_masuk_jumat, $awal_istirahat_jumat])
											    						->where('group.id', $groupid)
					    			 									->where('finger_id', $finger_id)
					    			 									->where('date', $tgl_attlog)
					    			 									->orderBy('time', 'desc')->first();
					    			 		//cek apakah user absen pagi
		    			 					if( empty($masuk) ) {
		    			 						//set default awal masuk jadi jam 9
		    			 						$waktu_masuk_jumat 	 		=  '09:00:00';
		    			 						$data_block['keterangan']	=  'Tidak Absen Pagi';
		    			 					} else {
		    			 						$waktu_masuk_jumat 			=  $masuk->time;
		    			 					}

											$data_block['masuk']	= '1';
											#############   MASUK PAGI ####################	
											if ($waktu_masuk_jumat > $akhir_masuk_jumat) {
												//terlambat
												$data_block['masuk_pagi']	= $waktu_masuk_jumat;
												$hitung_selisih = Hitung::selisih_menit($waktu_masuk_jumat, $akhir_masuk_jumat);
												$data_block['terlambat'] = '1';
												if( $hitung_selisih<=60) {
													$data_block['kategori_terlambat_id'] = '1';
													$data_block['potongan_terlambat']	 = '0.25';
												}
										        else if ($hitung_selisih<=75) {
										            $data_block['kategori_terlambat_id'] = '2';
										            $data_block['potongan_terlambat']	 = '0.5';
										        }
										        else if ($hitung_selisih<=90) {
										            $data_block['kategori_terlambat_id'] = '3';
										            $data_block['potongan_terlambat']	 = '1';
										        }
										        else if ($hitung_selisih<=105) {
										            $data_block['kategori_terlambat_id'] = '4';
										            $data_block['potongan_terlambat']	 = '1.5';
										        }
										        else if ($hitung_selisih<=120) {
										            $data_block['kategori_terlambat_id'] = '5';
										            $data_block['potongan_terlambat']	 = '2';
										        }
										        else if ($hitung_selisih<=240) {
										            $data_block['kategori_terlambat_id'] = '6';
										            $data_block['potongan_terlambat']	 = '2.5';
										        }
										    } else {
										    	$data_block['masuk_pagi']				 = $waktu_masuk_jumat;
										    	$data_block['terlambat']				 = '0';
										    	$data_block['kategori_terlambat_id']	 = '0';        
										    }
										    #############   MASUK PAGI ####################

										    #############  ISTIRAHAT ####################
											//cek dulu apa ada absen istirahat di kelompok
											if($absen_istirahat=='1') {
												$istirahat = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
													    						->whereBetween('time', [$awal_istirahat_jumat, $akhir_istirahat_jumat])
													    						->where('group.id', $groupid)
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
												$masuk_siang = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
														    						->whereBetween('time', [$awal_masuk_istirahat_jumat, $akhir_masuk_istirahat_jumat])
														    						->where('group.id', $groupid)
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
												// //cek apakah kategori_terlambat_id = 1
												// if($data_block['kategori_terlambat_id'] == '1') {
												// 	//set waktu pulang user = waktu kelompok pulang + terlambat
												// 	$awal_pulang_jumat = date('H:i:s', strtotime('+'.$hitung_selisih.' minute', strtotime($awal_pulang)) );
												// 	echo '<br>awal pulang jumat : '.$awal_pulang_jumat;
												// }

												$pulang = DB::table('attlog')->join('group','attlog.finger_group_id', '=', 'group.finger_group_id' )
												    						->whereBetween('time', [$akhir_masuk_istirahat_jumat, $akhir_pulang_jumat])
												    						->where('group.id', $groupid)
						    			 									->where('finger_id', $finger_id)
						    			 									->where('date', $tgl_attlog)
						    			 									->orderBy('time', 'desc')->first();
		    			 							if (empty($pulang)) {
		    			 								$data_block['pulang'] 			= '00:00:00';
		    			 								$data_block['keterangan']		= 'Tidak absen pulang';
		    			 								$data_block['kategori_psw_id']	= '6';
		    			 							} elseif($pulang->time < $awal_pulang_jumat) {
														//psw
														$data_block['psw']		= '1';
														$data_block['pulang']	= $pulang->time;
														$hitung_selisih_pulang  = Hitung::selisih_menit($awal_pulang_jumat, $pulang->time);
														if( $hitung_selisih_pulang<=60) {
															$data_block['kategori_psw_id'] = '1';
															$data_block['potongan_psw']	   = '0.25';
														}
												        else if ($hitung_selisih_pulang<=75) {
												            $data_block['kategori_psw_id'] = '2';
												            $data_block['potongan_psw']	   = '0.5';
												        }
												        else if ($hitung_selisih_pulang<=90) {
												            $data_block['kategori_psw_id'] = '3';
												            $data_block['potongan_psw']	   = '1';
												        }
												        else if ($hitung_selisih_pulang<=105) {
												            $data_block['kategori_psw_id'] = '4';
												            $data_block['potongan_psw']	   = '1.5';
												        }
												        else if ($hitung_selisih_pulang<=120) {
												            $data_block['kategori_psw_id'] = '5';
												            $data_block['potongan_psw']	   = '2';
												        }
												        else if ($hitung_selisih_pulang<=240) {
												            $data_block['kategori_psw_id'] = '6';
												            $data_block['potongan_psw']	   = '2.5';
												        }
												    } else {
												    	//cek apakah kategori_terlambat_id = 1
														if($data_block['kategori_terlambat_id'] == '1') {
															$ganti_pulang = date('H:i:s', strtotime('+'.$hitung_selisih.' minute', strtotime($awal_pulang_jumat)) );
															//jika user mengganti keterlambatan 1, set terlambat jadi 0
															if($pulang->time >= $ganti_pulang){
																$data_block['kategori_terlambat_id']	= '1';
																$data_block['potongan_terlambat']	 	= '0';
																$data_block['potongan_psw']	 			= '0';
																$data_block['ganti_terlambat']			= '1';
															} 														
														}
												    	$data_block['pulang']				 	 = $pulang->time;      
												    }
											} else {
												$data_block['pulang']			= '00:00:00';
											}
											#############  PULANG ####################


											############### HITUNG TOTAL JAM KERJA 1 HARI #################################
											if($absen_pulang == 1) {
												//jika user absen pulang
												//jika user absen pulang
												if(!empty($pulang->time)) {
													if( $data_block['psw'] == 0 && $data_block['terlambat'] == 0 ) {
														$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang_jumat, $akhir_masuk_jumat) - 90;
													} elseif( $data_block['psw'] == 1 && $data_block['terlambat'] == 0 ) {
														$data_block['jam_kerja']	=  Hitung::selisih_menit($pulang->time, $akhir_masuk_jumat) - 90;
													} elseif( $data_block['psw'] == 0 && $data_block['terlambat'] == 1 ) {
														if( $data_block['kategori_terlambat_id'] == 1 && $data_block['ganti_terlambat'] == 1 ) {
															$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang_jumat, $akhir_masuk_jumat) - 90;
														} else {
															$data_block['jam_kerja']	=  Hitung::selisih_menit($awal_pulang_jumat, $waktu_masuk_jumat) - 90;
														}
													}
												}
											}
											############### HITUNG TOTAL JAM KERJA 1 HARI #################################s

											//hitung total potongan
											$data_block['total_potongan'] 		= $data_block['potongan_terlambat'] + $data_block['potongan_psw'];
									}						
						}
					print_r($data_block);
					//insert data ke database perhitungan
					DB::table('perhitungan')->insert( $data_block );
    				}
    			}
    		}
    }

    ####################################### PRIVATE FUNCTION ##########################################
    //hitung potongan untuk cuti atau tidak masuk tanpa keterangan
    private static function get_data_tidak_masuk($user_id, $groupid, $tgl_attlog)
    {
    	$data = (object) '';
    	$cek_tgl = DB::table('izin')->where('users_id', $user_id)
									->where('group_id', $groupid)
									->where('tgl_mulai_izin', '<=', $tgl_attlog)
									->where('tgl_selesai_izin', '>=', $tgl_attlog)->count();
		if( $cek_tgl > 0 ) {
			// $get_potongan 	= DB::table('izin')->join('kategori_izin', 'izin.kode_izin', '=', 'kategori_izin.kode_izin')
			$get_potongan 	= DB::table('izin')
									->where('users_id', $user_id)
									->where('group_id', $groupid)
									->where('tgl_mulai_izin', '<=', $tgl_attlog)
									->where('tgl_selesai_izin', '>=', $tgl_attlog)->first();
			//cek apakah user izin dinas atau non dinas
			if( $get_potongan->dinas == '1') {
				$data->jam_kerja 		= '450';
				$data->masuk     		= '1';
				$data->total_potongan	= '0';
				$data->izin				= '0';
				$data->keterangan		= $get_potongan->keterangan;
			} else {
				$data->jam_kerja 		= '0';
				$data->masuk     		= '0';
				$potongan 		 		= $get_potongan->kode_izin;
				//ambil potongan berdasarkan kode
				$potongan 		 		= substr($potongan, 0, 1);
				$data->total_potongan	= $potongan;
				$data->izin				= '1';
				$data->keterangan		= $get_potongan->keterangan;
			}
		} else {
			$data->jam_kerja 		= '0';
			$data->masuk     		= '0';
			$data->total_potongan   = '5';
			$data->izin				= '0';
			$data->keterangan		= 'Tidak Masuk';
		}
		return $data;
    }

    private static function nama_hari($date)
	{
		$hari = date('N', strtotime($date));
		if($hari==1){  $hari='Senin'; }
		else if( $hari==2){$hari='Selasa'; }
		else if( $hari==3){$hari='Rabu'; }
		else if( $hari==4){$hari='Kamis'; }
		else if( $hari==5){$hari='Jum\'at'; }
		else if( $hari==6){$hari='Sabtu'; }
		else if( $hari==7){$hari='Minggu'; }
		return $hari;
	}

	private static function rentang_tanggal($dari_tgl, $sampai_tgl) {
		$mulai_tgl		= new DateTime( $dari_tgl );
        $akhir_tgl 		= new DateTime( $sampai_tgl );
        $akhir_tgl 		= $akhir_tgl->modify( '+1 day' ); 

        $interval 		= new DateInterval('P1D');
        $rentangtgl  	= new DatePeriod($mulai_tgl, $interval ,$akhir_tgl);

        return $rentangtgl;
	}

	 //cek libur
    private static function cek_libur($tgl) {
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

    private static function cek_jadwal_khusus($tglmulai, $tglakhir) {

    }

    private static function selisih_menit($time1, $time2) {
    	$time = abs( strtotime($time1) - strtotime($time2) );
        $time = round($time / 60);
        return $time;
    }

    private static function cek_jumat($tgl) {
    	$date  =  date('w', strtotime($tgl));
    	if($date == 5) {
    		$jumat = '1';
    	} else {
    		$jumat = '0';
    	}
    	return $jumat;
    }
    ####################################### PRIVATE FUNCTION ##########################################


			
}
