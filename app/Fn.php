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
    	$menit 	= $value / 60;
		$j  	= floor( $menit );
		$m  	= ($value - ($j * 60) );
		$total 	= $j.":".$m;
		return $total;
    }
}
