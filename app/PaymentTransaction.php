<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
   protected $table = 'payment_transaction'; 
    protected $fillable = [
        'payment_number','soa_id','payment_type_id','check_number','bank_id','amount_paid','trascation_date','user_id'
    ];
}
