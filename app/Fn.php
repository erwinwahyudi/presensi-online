<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fn extends Model
{
		public static function pisah_bulantahun($bulantahun) {
			$expbulantahun = explode("/", $bulantahun);
				$bulan 	= $expbulantahun[0];
				$tahun  = $expbulantahun[1];

			 return array('bulan' => $bulan,
							'tahun' => $tahun);
		}

		public static function total_jam_kerja($value) {
				//$value  = $value - 60; //kurang 60menit waktu istirahat
				$menit 	= $value / 60;
		$j  	= floor( $menit );
		$m  	= ($value - ($j * 60) );
		$total 	= $j.":".$m;
		return $total;
		}

		public static function date_to_string($date){
				if($date!=NULL){
						$date = explode('-', $date);

						if($date[1]=='01'){
								$bulan = 'Januari';
						} else if($date[1]=='02') {
								$bulan = 'Februari';
						} else if($date[1]=='03') {
								$bulan = 'Maret';
						} else if($date[1]=='04') {
								$bulan = 'April';
						} else if($date[1]=='05') {
								$bulan = 'Mei';
						} else if($date[1]=='06') {
								$bulan = 'Juni';
						} else if($date[1]=='07') {
								$bulan = 'Juli';
						} else if($date[1]=='08') {
								$bulan = 'Agustus';
						} else if($date[1]=='09') {
								$bulan = 'September';
						} else if($date[1]=='10') {
								$bulan = 'Oktober';
						} else if($date[1]=='11') {
								$bulan = 'November';
						} else if($date[1]=='12') {
								$bulan = 'Desember';
						}

						$tgl = (int)$date[2];

						return $tgl.' '.$bulan.' '.$date[0];
				}
		}

		public static function tgl_to_bulan($date){
				if($date!=NULL){
						$date = explode('-', $date);

						if($date[1]=='01'){
								$bulan = 'Januari';
						} else if($date[1]=='02') {
								$bulan = 'Februari';
						} else if($date[1]=='03') {
								$bulan = 'Maret';
						} else if($date[1]=='04') {
								$bulan = 'April';
						} else if($date[1]=='05') {
								$bulan = 'Mei';
						} else if($date[1]=='06') {
								$bulan = 'Juni';
						} else if($date[1]=='07') {
								$bulan = 'Juli';
						} else if($date[1]=='08') {
								$bulan = 'Agustus';
						} else if($date[1]=='09') {
								$bulan = 'September';
						} else if($date[1]=='10') {
								$bulan = 'Oktober';
						} else if($date[1]=='11') {
								$bulan = 'November';
						} else if($date[1]=='12') {
								$bulan = 'Desember';
						}

						return $bulan;
				}
		}

		public static function to_bulan($value)
		{
			if($value=='01'){
					$bulan = 'Januari';
			} else if($value=='02') {
					$bulan = 'Februari';
			} else if($value=='03') {
					$bulan = 'Maret';
			} else if($value=='04') {
					$bulan = 'April';
			} else if($value=='05') {
					$bulan = 'Mei';
			} else if($value=='06') {
					$bulan = 'Juni';
			} else if($value=='07') {
					$bulan = 'Juli';
			} else if($value=='08') {
					$bulan = 'Agustus';
			} else if($value=='09') {
					$bulan = 'September';
			} else if($value=='10') {
					$bulan = 'Oktober';
			} else if($value=='11') {
					$bulan = 'November';
			} else if($value=='12') {
					$bulan = 'Desember';
			}

			return $bulan;
		}
}
