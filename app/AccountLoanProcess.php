<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountLoanProcess extends Model
{
    protected $table = 'account_loan_processes';
    protected $fillable = [
    	'loan_process_id', 'account_id', 'comments', 'status'
    ];

    public function loanprocess(){
    	return $this->belongsTo(LoanProcess::class, 'loan_process_id');
    }
}
