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

    }

}
