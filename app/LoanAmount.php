<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanAmount extends Model
{
    protected $table = 'loan_amounts'; 
    protected $fillable = [
    	'amount'
    ];

    public function deductions(){
    	return $this->hasMany(ChargesDetails::class, 'loan_amount_id', 'id');
    }
}
