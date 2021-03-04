<?php

use Illuminate\Database\Seeder;
use App\ModuleAccess;
class ModuleAccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModuleAccess::insert([
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
        ]);
    }
}
