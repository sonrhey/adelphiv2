<?php

use Illuminate\Database\Seeder;
use App\AccountSoaStatus;
class AccountSoaStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountSoaStatus::insert([
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Approved',
            ],
        ]);
    }
}
