<?php

use Illuminate\Database\Seeder;
use App\UnitOfMeasure;
class UnitMeasureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitOfMeasure::insert([
        	[
	        	'name' => 'square meter',
	        	'code' => 'sq'
	        ],
	        [
	        	'name' => 'hectare',
	        	'code' => 'h'
	        ]
        ]);
    }
}
