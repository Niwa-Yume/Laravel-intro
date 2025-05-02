<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        // Appel des seeders personnalisés
        $this->call([
            CountrySeeder::class,
            ExistingArtistSeeder::class, //les artistes de base
            ExistingMovieSeeder::class, //les films de base
            CinemaSeeder::class, //les cinémas de base
        ]);
    }
}
