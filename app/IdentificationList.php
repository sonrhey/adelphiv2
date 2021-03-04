<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationList extends Model
{
    protected $table = 'identification_list'; 
    protected $fillable = [
        'name', 'code'
    ];
}
