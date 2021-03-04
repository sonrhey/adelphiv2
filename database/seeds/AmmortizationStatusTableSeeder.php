<?php

use Illuminate\Database\Seeder;
use App\AmmortizationStatus;

class AmmortizationStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmmortizationStatus::insert([
        	[
    		    'name' => 'FOR PAYMENT',
            ],
            [
                'name' => 'PAID',
            ],
            [
                'name' => 'PAST DUE',
            ],
            [
                'name' => 'PARTIAL PAYMENT',
            ]
        ]);
    }
}
