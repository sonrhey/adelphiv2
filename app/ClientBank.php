<?php

namespace App;

use App\Bank;
use Illuminate\Database\Eloquent\Model;

class ClientBank extends Model
{
    protected $table = 'client_bank'; 
    protected $fillable = [
        'bank_id','branch_location','account_number','account_name','year_opened','client_id','added_by','updated_by'
    ];

    public function bankName(){
    	return $this->belongsTo(Bank::class,'bank_id');
    }
}
