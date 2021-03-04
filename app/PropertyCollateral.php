<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyCollateral extends Model
{
    protected $table = 'property_collateral'; 
    protected $fillable = [
        'account_id','name_registered', 'city_id','barangay_id','property_address','title_number','tax_declaration_number','lot_area','unit_measure_id','property_type_id','date_acquired','acquisition_type','acquisition_price','current_value','attachment_id','added_by','updated_by'
    ];
}
