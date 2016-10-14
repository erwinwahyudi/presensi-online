<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    // inisiasi kolom mana saja yg boleh diisi
    protected $fillable = ['finger_group_id', 'nama_group', 'active'];
    // inisiasi kolom yg tidak ditampilkan ketika view
    protected $hidden = [];
    // protected $guarded =['updated_at'];

    public function user() {
    	return $this->hasMany('\App\User');
    }

    public function kelompok() {
    	return $this->hasMany('\App\Kelompok');
    }
}
