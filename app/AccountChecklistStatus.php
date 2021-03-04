<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountChecklistStatus extends Model
{
    protected $table = 'account_checklist_status'; 
    protected $fillable = [ 'name'
    ];
}
