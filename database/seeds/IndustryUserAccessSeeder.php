<?php

use App\UserAccess;
use Illuminate\Database\Seeder;

class IndustryUserAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAccess::insert([
            [
                'module_id' => 15,
                'user_type_id' => 1,
                'grant' => 1,
            ],
        ]);
    }
}
