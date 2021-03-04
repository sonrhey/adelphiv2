<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';
    protected $fillable = [
    	'property_type_id', 'name', 'code', 'loan_process_id'
    ];
}
