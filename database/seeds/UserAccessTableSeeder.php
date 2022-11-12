<?php

use Illuminate\Database\Seeder;
use App\UserAccess;
class UserAccessTableSeeder extends Seeder
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
        		'module_id' => 1,
				'user_type_id' => 1,
				'grant' => 1,
        	],
        	[
        		'module_id' => 2,
				'user_type_id' => 1,
				'grant' => 1,
        	],
            [
                'module_id' => 3,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 4,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 5,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 6,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 7,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 8,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 9,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 10,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 11,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 12,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 13,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 14,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 15,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 16,
                'user_type_id' => 1,
                'grant' => 1,
            ],
            [
                'module_id' => 17,
                'user_type_id' => 1,
                'grant' => 1,
            ],
        ]);
    }
}
