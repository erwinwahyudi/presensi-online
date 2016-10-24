<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    protected $table 	= 'perhitungan';
    public $timestamps	= false;

    public function users() {
    	return $this->belongsTo('\App\Users');
    }

    public function kategori_terlambat() {
    	return $this->belongsTo('\App\KategoriTerlambat');
    }

    public function kategori_psw() {
    	return $this->belongsTo('\App\KategoriPsw');
    }
}
