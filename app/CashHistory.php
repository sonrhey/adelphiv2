<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashHistory extends Model
{
    protected $table = 'cash_history';
    protected $fillable = [
    	'cash_id', 'account_id', 'deducted_amount', 'remaining_balance', 'loan_schedule_id', 'amount_paid'
    ];
}
