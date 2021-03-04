<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountIdentification extends Model
{
	protected $table = 'account_identifications';
    protected $fillable = [
        'account_id','identification_list_id','id_number','added_by','updated_by'
    ];
}
