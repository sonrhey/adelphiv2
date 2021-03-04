<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules'; 
    protected $fillable = [
        'name','has_sub','routes','parent', 'visible', 'sequence', 'icon'
    ];
}
