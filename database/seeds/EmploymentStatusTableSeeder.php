<?php

use Illuminate\Database\Seeder;
use App\EmploymentStatus;

class EmploymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmploymentStatus::insert([
        	[
        		'name' => 'Probationary',
        	],
        	[
        		'name' => 'Regular',
        	],
        ]);
    }
}
