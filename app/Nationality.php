<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
class Nationality extends Model
{
    protected $table = 'nationalities'; 
    protected $fillable = [
        'name'
       
    ];
    public function client(){
    	return $this->hasOne(Client::class);
    }
}
