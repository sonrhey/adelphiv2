<?php

use Illuminate\Database\Seeder;
use App\Bank;
class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::insert([
        	[
        		'code' => 'BDO',
        		'name' => 'Banco De Oro',
        	],
        	[
        		'code' => 'BPI',
        		'name' => 'Bank of the Philippine Island',
        	],
        ]);
    }
}
