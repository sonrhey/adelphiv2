<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industries';
    protected $fillable = [
    	'code', 'name'
    ];
}
