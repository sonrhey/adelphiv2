<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmmortizationStatus extends Model
{
    protected $table = 'ammortization_status'; 
    protected $fillable = ['name'];
}
