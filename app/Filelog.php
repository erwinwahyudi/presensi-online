<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filelog extends Model
{
    protected $table 	= 'filelog';
    protected $fillable	= ['user_id', 'group_id', 'bulan_tahun', 'real_name', 'filename'];
    // protected $hidden	= ['created_at', 'updated_at'];
    
}
