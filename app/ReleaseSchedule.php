<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseSchedule extends Model
{
    protected $table = 'release_schedule'; 
    protected $fillable = [
        'account_id','date','release_schedule_status'
    ];
}
