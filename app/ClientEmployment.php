<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientEmployment extends Model
{
    protected $table = 'client_employment'; 
    protected $fillable = [
        'client_id','company_name','position','length_stay','address','city_id','barangay_id','email','contact_number','mobile_number','monthly_income','employment_status_id','industry_id','added_by','updated_by'
    ];
    public function city(){
    	return $this->belongsTo(City::class,'city_id');
    }
    public function barangay(){
    	return $this->belongsTo(Barangay::class,'barangay_id');
    }
    public function employmentStatus(){
    	return $this->belongsTo(EmploymentStatus::class,'employment_status_id');
    }
    public function industry(){
    	return $this->belongsTo(Industry::class,'industry_id');
    }
}
