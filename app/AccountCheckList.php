<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCheckList extends Model
{
    protected $table = 'account_checklist'; 
    protected $fillable = [
        'account_id','check_number','check_date','check_ammount','bank_id','account_checklist_status_id'
    ];
}
