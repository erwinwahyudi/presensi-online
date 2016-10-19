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
}
