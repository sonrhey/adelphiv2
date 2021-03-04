<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    protected $table = 'employment_status'; 
    protected $fillable = [
        'name'
    ];
}
