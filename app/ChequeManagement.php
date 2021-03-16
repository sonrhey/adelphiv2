<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChequeManagement extends Model
{
    protected $table = 'cheque_management';
    protected $fillable = [
    	'client_id', 'bank_id', 'cheque_name', 'cheque_value'
    ];
    public function client_name(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function bank_name(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
