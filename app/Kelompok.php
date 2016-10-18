<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table 	= 'kelompok';
	protected $fillable = ['nama_kelompok', 'group_id', 'awal_masuk', 'akhir_masuk', 'awal_masuk_jumat', 'akhir_masuk_jumat', 'absen_istirahat', 'awal_istirahat', 'akhir_istirahat', 'awal_istirahat_jumat', 'akhir_istirahat_jumat', 'absen_masuk_istirahat', 'awal_masuk_istirahat', 'akhir_masuk_istirahat', 'awal_masuk_istirahat_jumat', 'akhir_masuk_istirahat_jumat', 'absen_pulang', 'awal_pulang', 'akhir_pulang', 'awal_pulang_jumat', 'akhir_pulang_jumat', 'hitung_lembur', 'nama_penandatangan1', 'nip_penandatangan1', 'jabatan_penandatangan1', 'nama_penandatangan2', 'nip_penandatangan2', 'jabatan_penandatangan2'];
	protected $hidden 	= ['created_at', 'updated_at'];

	public function group(){
		return $this->belongsTo('\App\Group');
	}

	public function user(){
		return $this->hasMany('\App\User');
	}
}
