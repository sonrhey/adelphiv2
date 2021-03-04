<?php

use Illuminate\Database\Seeder;
use App\PropertyType;
class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::insert([
        	[
        		'name' => 'condominium'
			],
			[
        		'name' => 'Apartment'
			],
			[
        		'name' => 'Residential'
			],
        ]);
    }
}
