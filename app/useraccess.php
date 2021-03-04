<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
   protected $table = 'user_access'; 
    protected $fillable = [
        'module_id','user_type_id','grant'
    ];
}
