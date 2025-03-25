<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'title' => 'Man of Steel',
                'year' => 2013,
                'director_id' => 2,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Batman v Superman: Dawn of Justice',
                'year' => 2016,
                'director_id' => 2,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wonder Woman',
                'year' => 2017,
                'director_id' => 3,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Aquaman',
                'year' => 2018,
                'director_id' => 4,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Shazam!',
                'year' => 2019,
                'director_id' => 5,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Birds of Prey',
                'year' => 2020,
                'director_id' => 6,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Zack Snyder\'s Justice League',
                'year' => 2021,
                'director_id' => 2,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Batman',
                'year' => 2022,
                'director_id' => 7,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Black Adam',
                'year' => 2022,
                'director_id' => 8,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Aquaman and the Lost Kingdom',
                'year' => 2023,
                'director_id' => 4,
                'country_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}
