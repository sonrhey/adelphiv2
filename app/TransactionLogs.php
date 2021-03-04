<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLogs extends Model
{
    protected $table = 'transaction_logs';
    protected $fillable = [
    	'transaction_type', 'transaction_id', 'previous_amt', 'current_amt'
    ];
}
