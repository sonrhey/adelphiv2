<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'barangays';
    protected $fillable = [
    	'city_id','name'
    ];
    public function City(){
    	return $this->belongsTo(City::class);
    }
}
