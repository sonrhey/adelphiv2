<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChequeHistory extends Model
{
    protected $table = 'cheque_history';
    protected $fillable = [
    	'cheque_id', 'account_id', 'deducted_amount', 'deducted_amount', 'remaining_balance', 'loan_schedule_id'
    ];
}
