<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([[
            'name' => 'Roumanie',
        ],[
            'name' => 'Japon',
        ],[
            'name' => 'Chine',
        ],[
            'name' => 'Taiwan',
        ],[
            'name' => 'Mongolie',
        ],[
            'name' => 'Colombie',
        ],[
            'name' => 'Mexique',
        ],[
            'name' => 'Venezuela',
        ],[
            'name' => 'Italie',
        ],[
            'name' => 'Australie',
        ]]);
    }
}
