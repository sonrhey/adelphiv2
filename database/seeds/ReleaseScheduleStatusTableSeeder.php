<?php

use Illuminate\Database\Seeder;
use App\ReleaseScheduleStatus;
class ReleaseScheduleStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReleaseScheduleStatus::insert([
        	[
        		'name' => 'Pending',
        	],
        	[
        		'name' => 'Approved',
        	],
        ]);
    }
}
