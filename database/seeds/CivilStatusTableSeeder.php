<?php

use Illuminate\Database\Seeder;
use App\CivilStatus;


class CivilStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CivilStatus::insert([
        	[
        		'name' => 'Single',
        	],
        	[
        		'name' => 'Married',
        	],
        	[
        		'name' => 'Divorced',
        	],
        	[
        		'name' => 'Seperated',
        	],
        	[
        		'name' => 'Legaly Separated',
        	]
        ]);
    }
}
