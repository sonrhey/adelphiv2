<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanTracker extends Model
{
    protected $table = 'loan_tracker';
    protected $fillable = [
    	'account_id',
        'cycle_counter'
    ];
}
