<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientRelation extends Model
{
    protected $table = 'client_relations';
    protected $fillable = [
    	'name'
    ];
    public function client_family(){
    	return $this->hasMany(ClientFamily::class);
   }
}