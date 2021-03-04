<?php

use Illuminate\Database\Seeder;
use App\ClientRelation;
class ClientRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientRelation::insert([
        	[
        		'name' => 'Father',
        	],
        	[
        		'name' => 'Mother',
        	],
        	[
        		'name' => 'Wife',
        	],
        	[
        		'name' => 'Husband',
        	],
        	[
        		'name' => 'Son',
        	],
        	[
        		'name' => 'Daughter',
        	],
        ]);
    }
}
