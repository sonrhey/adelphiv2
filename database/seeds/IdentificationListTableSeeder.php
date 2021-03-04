<?php

use App\IdentificationList;
use Illuminate\Database\Seeder;

class IdentificationListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IdentificationList::insert([
        	[
        		'name' => 'UMID',
        		'code' => 'SSS'
        	],
        	[
        		'name' => 'Drivers License',
        		'code' => 'DL'
        	],
            [
                'name' => 'Phil. Health ID',
                'code' => 'PHID'
            ],
            [
                'name' => 'PAGIBIG ID',
                'code' => 'PAGIBIG'
            ],
            [
                'name' => 'GSIS ID',
                'code' => 'GSIS'
            ],
            [
                'name' => 'NBI Clearance',
                'code' => 'NBIC'
            ],
            [
                'name' => 'TIN',
                'code' => 'TIN'
            ],
            [
                'name' => 'Voters ID',
                'code' => 'VID'
            ],
            [
                'name' => 'Senior Citizen ID',
                'code' => 'SC'
            ],
            [
                'name' => 'PRC ID',
                'code' => 'PRC'
            ],
            [
                'name' => 'Passport ID',
                'code' => 'PID'
            ],

        ]);
    }
}
