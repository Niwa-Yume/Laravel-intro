<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

// public function run()
// {
//     DB::table('artists')->insert([[
//         'name' => 'Coppola',
//         'firstname' => 'Francis Ford',
//         'birthdate' => 1939,
//     ],[
//         'name' => 'Lynch',
//         'firstname' => 'David',
//         'birthdate' => 1946,
//     ]]);
// }

    public function run(){
        Artist::factory()
            ->count(50)
            ->create();
    }
}
