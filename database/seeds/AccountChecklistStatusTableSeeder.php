<?php

use Illuminate\Database\Seeder;
use App\AccountChecklistStatus;
class AccountChecklistStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountChecklistStatus::insert([
        	[
        		'name' => 'Pending',
        	],
        	[
        		'name' => 'Approved',
        	],
        ]);
    }
}
