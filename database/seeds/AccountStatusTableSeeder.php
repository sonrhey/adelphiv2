<?php

use Illuminate\Database\Seeder;
use App\AccountStatus;
class AccountStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountStatus::insert([
        	[
    		  'name' => 'Pending',
	    	],
            [
                'name' => 'Processing',
            ],
	    	[
	    		'name' => 'Approved',
            ],
            [
	    		'name' => 'Paid',
	    	],
        ]);
    }
}
