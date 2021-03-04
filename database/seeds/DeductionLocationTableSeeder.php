<?php

use Illuminate\Database\Seeder;
use App\DeductionLocation;

class DeductionLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeductionLocation::insert([
        	[
        		'location_name' => 'Cebu City'
        	],
        	[
        		'location_name' => 'Province'
        	],
        ]);
    }
}
