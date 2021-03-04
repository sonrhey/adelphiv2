<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseScheduleStatus extends Model
{
    protected $table = 'release_schedule_status'; 
    protected $fillable = [
        'name'
    ];
}
