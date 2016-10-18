<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attlog extends Model
{
    protected $table 	=  'attlog';
    protected $fillable	=  ['datetime', 'date', 'time', 'user_id', 'group_id'];
    public $timestamps	= false;
}
