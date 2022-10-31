<?php

use App\Module;
use Illuminate\Database\Seeder;

class IndustryModuleSeeder extends Seeder
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
                'name' => 'Industry',
                'has_sub' => 0,
                'routes' => 'industry',
                'parent' => 1,
                'icon' => NULL,
                'sequence' => 10,
                'visible' => 1,
            ],
        ]);
    }
}
