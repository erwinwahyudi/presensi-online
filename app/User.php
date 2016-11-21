<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	 /**
	  * The attributes that are mass assignable.
	  *
	  * @var array
	  */
	 protected $fillable = [
		  'finger_id', 'username', 'password', 'nama', 'nip', 'jabatan', 'golongan', 'foto', 'level', 'email',  'group_id', 'kelompok_id',
	 ];

	 /**
	  * The attributes that should be hidden for arrays.
	  *
	  * @var array
	  */
	 protected $hidden = [
		  'password', 'remember_token',
	 ];

	 public function group(){
		  return $this->belongsTo('\App\Group');
	 }

	 public function izin() {
		  return $this->hasMany('\App\Izin');
	 }

	 public function kelompok() {
		  return $this->belongsTo('\App\Kelompok');
	 }
}
