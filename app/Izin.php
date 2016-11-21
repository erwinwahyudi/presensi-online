<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
	 protected $table	= 'izin';
	 protected $fillable	= ['users_id', 'group_id', 'tgl_mulai_izin', 'dinas', 'tgl_selesai_izin', 'kode_izin', 'keterangan', 'file_surat'];

	 public function user() {
		  return $this->belongsTo('\App\User');
	 }
}
