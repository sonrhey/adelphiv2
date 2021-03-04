<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanProcess extends Model
{
	protected $table = 'loan_processes';
    protected $fillable = [
    	'name'
    ];
}
