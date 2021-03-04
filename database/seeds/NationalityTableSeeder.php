<?php

use Illuminate\Database\Seeder;
use App\Nationality;

class NationalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nationality::insert([
        	[
        		'name' => 'Filipino'
        	],
        ]);
    }
}
