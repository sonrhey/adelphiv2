<?php

use Illuminate\Database\Seeder;
use App\Branch;
class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::insert([
        	[
        		'code' => 'AP',
        		'name' => 'Adelphi Pardo',
        		'contact_number' => '0393903',
        		'address' => 'Pardo'
        	],
        ]);
    }
}
