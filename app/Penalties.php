<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalties extends Model
{
    protected $table = 'penalties';
    protected $fillable = [
    	'name',
        'percentage',
        'equivalent',
    ];

}
