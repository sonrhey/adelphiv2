<?php

use App\LoanProcess;
use Illuminate\Database\Seeder;

class LoanProcessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoanProcess::insert([
        	[
        		'name' => 'Requirements'
        	],
        	[
        		'name' => 'Appraisal and Traceback'
        	],
            [
                'name' => 'Schedule for Releasing'
            ],
        	[
        		'name' => 'Releasing'
        	],
        	[
        		'name' => 'Notorial'
        	],
        	[
        		'name' => 'Annotation'
        	],
        ]);
    }
}
