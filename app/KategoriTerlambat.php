<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriTerlambat extends Model
{
    protected $table = 'kategori_terlambat';

    public function perhitungan() {
    	return $this->hasMany('\App\Perhitungan');
    }
}
