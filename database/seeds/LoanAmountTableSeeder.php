<?php

use Illuminate\Database\Seeder;
use App\LoanAmount;
class LoanAmountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoanAmount::insert([
        	[
        		'amount' => '110000'
        	],
        	[
        		'amount' => '120000'
        	],
        	[
        		'amount' => '130000'
        	],
        	[
        		'amount' => '140000'
        	],
        	[
        		'amount' => '150000'
        	],
        	[
        		'amount' => '160000'
        	],

        ]);
    }
}
