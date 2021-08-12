<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPaymentHistory extends Model
{
    protected $table = 'loan_payment_history';
    protected $fillable = [
    	'account_id', 'ammortization_id', 'previous_amount', 'current_amount', 'deducted_amount', 'payment_type_id'
    ];
    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    public function payment_type(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id', 'id');
    }
}
