<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmmortizationSchedule extends Model
{
    protected $table = 'ammortization'; 
    protected $fillable = [
        'account_id','due_date','due_ammount','interest','principal','balance', 'penalty','ammortization_schedule_status_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function ammortization_status(){
        return $this->belongsTo(AmmortizationStatus::class,  'ammortization_schedule_status_id', 'id');
    }
}
