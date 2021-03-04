<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeductionLocation extends Model
{
    protected $table = 'deduction_locations';
    protected $fillable = [
    	'location_name'
    ];
}
