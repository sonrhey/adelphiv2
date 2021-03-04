<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSoa extends Model
{
    protected $table = 'account_soa'; 
    protected $fillable = [
        'soa_number','account_id','ammortization_id','due_ammount','due_date','balance_amount','interest_amount','total_ammount_due','account_soa_status_id','updated_by'
    ];
}
