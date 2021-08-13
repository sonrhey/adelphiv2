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


//loan transaction
// TRUNCATE TABLE account_identifications
// TRUNCATE TABLE account_loan_processes
// TRUNCATE TABLE ammortization
// TRUNCATE TABLE cash_history
// TRUNCATE TABLE cash_management
// TRUNCATE TABLE cheque_history
// TRUNCATE TABLE cheque_management
// TRUNCATE TABLE loan_payment_history
// TRUNCATE TABLE mst_account
// TRUNCATE TABLE release_schedule
