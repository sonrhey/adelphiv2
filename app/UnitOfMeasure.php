<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
    protected $table = 'unit_measures';
    protected $fillable = [
    	'name', 'code'
    ];
}
