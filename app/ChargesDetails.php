<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargesDetails extends Model
{
    protected $table = 'charges_details'; 
    protected $fillable = [
    	'loan_amount_id','commission_amount','service_fee_amount','total_handling_fee','promi_note','spa','rem','total_notarial','appraisal','chart_fee','formulated_fee','fixed_amount','legal_fee','total_annotation','document_stamp','relocation_fee','insurance','taxes','total_deductions','net_proceeds','location_deduction_id'
    ];

    public function loanamounts(){
    	return $this->belongsTo(LoanAmount::class, 'loan_amount_id');
    }
}
