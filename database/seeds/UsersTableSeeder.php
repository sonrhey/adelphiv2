<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[
        		'username' => 'admin',
        		'first_name' => 'Admin',
        		'middle_name' => 'Admin',
        		'last_name' => 'Admin',
	            'password' => Hash::make('123123'),
	           	'user_type_id' => 1,
        	],
        ]);
    }
}
