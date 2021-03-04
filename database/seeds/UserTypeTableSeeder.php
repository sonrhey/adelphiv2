<?php

use Illuminate\Database\Seeder;
use App\UserType;
class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::insert([
        	'name' => 'Super Admin',
        ]);
    }
}
