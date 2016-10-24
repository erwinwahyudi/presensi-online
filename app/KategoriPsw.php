<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPsw extends Model
{
    protected $table = 'kategori_psw';

    public function perhitungan() {
    	return $this->hasMany('\App\Perhitungan');
    }
}
