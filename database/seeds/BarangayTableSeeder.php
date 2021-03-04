<?php

use Illuminate\Database\Seeder;
use App\Barangay;
class BarangayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barangay::insert([
        	[
        		'city_id' => 1,
        		'name' => 'Dulho'
        	],
        ]);
    }
}
