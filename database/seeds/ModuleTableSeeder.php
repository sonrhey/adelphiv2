<?php

use Illuminate\Database\Seeder;
use App\Module;
class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::insert([
        	[
        		'name' => 'Maintenance',
	            'has_sub' => 1,
	            'routes' => 'maintenance',
	            'parent' => 0,
                'icon' => NULL,
                'sequence' => 1,
	            'visible' => 1,
        	],
        	[
        		'module_name' => 'User Maintenance',
	            'has_sub' => 0,
	            'routes' => 'usermaintenance',
	            'parent' => 1,
                'icon' => NULL,
                'sequence' => 1,
                'visible' => 1,
        	],
            [
                'module_name' => 'Client',
                'has_sub' => 0,
                'routes' => 'clients',
                'parent' => 0,
                'icon' => NULL,
                'sequence' => 1,
                'visible' => 1,
            ],
            [
                'module_name' => 'Banks',
                'has_sub' => 0,
                'routes' => 'banks',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 2,
                'visible' => 1,
            ],
            [
                'module_name' => 'Accounts',
                'has_sub' => 0,
                'routes' => 'accounts',
                'parent' => 0,
                'icon' => NULL,
                'sequence' => 1,
                'visible' => 1,
            ],
            [
                'module_name' => 'Loan Amount',
                'has_sub' => 0,
                'routes' => 'loan_amount',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 3,
                'visible' => 1,
            ],
            [
                'module_name' => 'Nationality',
                'has_sub' => 0,
                'routes' => 'nationality',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 4,
                'visible' => 1,
            ],
            [
                'module_name' => 'City',
                'has_sub' => 0,
                'routes' => 'cities',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 5,
                'visible' => 1,
            ],
            [
                'module_name' => 'Barangay',
                'has_sub' => 0,
                'routes' => 'barangays',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 6,
                'visible' => 1,
            ],
            [
                'module_name' => 'Identification List',
                'has_sub' => 0,
                'routes' => 'identification_list',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 7,
                'visible' => 1,
            ],
            [

                'module_name' => 'Modules',
                'has_sub' => 0,
                'routes' => 'addmodules',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 8,
                'visible' => 1,
            ],
            [

                'module_name' => 'Payment',
                'has_sub' => 0,
                'routes' => 'payment',
                'parent' => 0,
                'icon' => NULL,
                'sequence' => 10,
                'visible' => 1,
            ],
            [
                'module_name' => 'Penalties',
                'has_sub' => 0,
                'routes' => 'penalties',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 9,
                'visible' => 1,
            ],
            [
                'module_name' => 'Cheque Management',
                'has_sub' => 0,
                'routes' => 'chequemanagement',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 9,
                'visible' => 1,
            ],
        ]);
    }
}
