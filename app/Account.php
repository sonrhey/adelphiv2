<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'mst_account'; 
    protected $fillable = [
        'loan_amount_id', 'approved_load_amount_id','account_number','client_id','loan_amount','approved_loan_amount','loan_type_id','branch_id','account_status_id','added_by','updated_by','reviewed_by','appraised_by','approved_by','released_by'
    ];
    public function property_collateral()
    {
    	return $this->hasMany(PropertyCollateral::class);
    }
    public function account_identification()
    {
    	return $this->hasMany(AccountIdentification::class);
    }

    public function status(){
        return $this->belongsTo(AccountStatus::class, 'account_status_id', 'id');
    }

    public function client(){
        return $this->belongsTo(client::class, 'client_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function ammortization(){
        return $this->hasMany(AmmortizationSchedule::class, 'account_id', 'id');
    }

    public function loan_type(){
        return $this->belongsTo(LoanType::class, 'loan_type_id', 'id');
    }
}
