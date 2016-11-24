<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalKhusus extends Model
{
    protected $table 	= 'jadwal_khusus';
    protected $fillable	= [ 'keterangan', 'tanggal_mulai', 'tanggal_selesai', 'awal_masuk', 'akhir_masuk', 'awal_masuk_jumat', 'akhir_masuk_jumat', 'absen_istirahat', 'awal_istirahat', 'akhir_istirahat', 'awal_istirahat_jumat', 'akhir_istirahat_jumat', 'absen_masuk_istirahat', 'awal_masuk_istirahat', 'akhir_masuk_istirahat', 'awal_masuk_istirahat_jumat',
							'akhir_masuk_istirahat_jumat', 'absen_pulang', 'awal_pulang', 'akhir_pulang', 'awal_pulang_jumat', 'akhir_pulang_jumat', 'level', 'created_by', 'group_id' ];
	protected $hidden 	= ['created_at', 'updated_at'];
}
