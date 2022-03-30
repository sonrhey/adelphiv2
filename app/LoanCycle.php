<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanCycle extends Model
{
    protected $table = 'loan_cycle';
    protected $fillable = [
    	'account_id',
        'cycle_count',
        'total_cycle_payment',
        'cycle_status'
    ];
}
