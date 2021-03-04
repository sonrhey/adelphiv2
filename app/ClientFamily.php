<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientFamily extends Model
{
   	protected $table = 'client_family'; 
    protected $fillable = [
        'first_name','middle_name','last_name','suffix','client_relation_id','birth_date','civil_status_id','gender','nationality_id','email_address','mobile_number','landline_number','address_1','city1_id','barangay1_id','length_stay_1','address_2','city2_id','barangay2_id','length_stay_2','status','client_id','added_by','updated_by'
    ];
    public function client_relation(){
    	return $this->belongsTo(ClientRelation::class);
    }
    public function civil_status (){
    	return $this->belongsTo(CivilStatus::class);
    }
    public function nationality (){
    	return $this->belongsTo(Nationality::class);
    }
    public function barangay1 (){
    	return $this->belongsTo(Barangay::class,'barangay1_id');
    }
    public function barangay2 (){
    	return $this->belongsTo(Barangay::class,'barangay2_id');
    }
    public function city1 (){
    	return $this->belongsTo(City::class,'city1_id');
    }
    public function city2 (){
    	return $this->belongsTo(Barangay::class,'city2_id');
    }
}
