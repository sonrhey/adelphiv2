<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryLedger extends Model
{
    protected $table = 'subsidiary_ledgers';
    protected $guarded = [];

    public function transactionable()
    {
        return $this->morphTO();
    }

    public function memberable()
    {
        return $this->morphTo();
    }
}
