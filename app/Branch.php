<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
    	'code', 'name', 'contact_number', 'address'
    ];
}
