<?php

use Illuminate\Database\Seeder;
use App\Loantype;
class LoanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoanType::insert([
        	[
        		'code' => NULL,
        		'name' => 'Ammortized'
        	],
        	[
        		'code' => NULL,
        		'name' => 'Interest Only'
        	]
        ]);
    }
}
