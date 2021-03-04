<?php

use App\Requirement;
use Illuminate\Database\Seeder;

class RequirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requirement::insert([
        	[
        		'property_type_id' => 1,
        		'name' => 'Tax Dec of Lot - Certified True Copy - Recent copy',
        		'loan_process_id' => 1
        	],
        	[
        		'property_type_id' => 2,
        		'name' => 'Tax Dec of Lot - Certified True Copy - Recent copy',
        		'loan_process_id' => 1
        	],
        	[
        		'property_type_id' => 2,
        		'name' => 'Tax Dec of Lot - Certified True Copy - Recent copy',
        		'loan_process_id' => 1
        	],
        ]);
    }
}
