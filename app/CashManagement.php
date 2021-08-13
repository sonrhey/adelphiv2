<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashManagement extends Model
{
    protected $table = 'cash_management';
    protected $fillable = [
    	'id', 'client_id', 'bank_id', 'amount'
    ];
    public function client_name(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
