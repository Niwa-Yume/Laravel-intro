<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExistingMovieSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // 1. On récupère le tableau généré par le dump
        $movies = include database_path('dumps/movies_dump.php');

        // 2. On insère tout d'un coup (plus rapide que create() en boucle)
        Movie::insert($movies);

        // Relations many-to-many pour les acteurs et réalisateurs
        $movieActors = [
            // [movie_id, artist_id, role_name]
            // Relations issues de artist_movie.sql
            [5, 2, 'Captain America'],
            [2, 5, 'Directeur'],
            [2, 5, 'Acteur'],
            [2, 2, 'Acteur'],
            [3, 1, 'Directeur'],
            [1, 1, 'Directeur'],
            [1, 1, 'Acteur'],
            [3, 1, 'Acteur'],

            // Ajout des films DC Comics (relations déduites)
            [35, 2, 'Directeur'],
            [36, 2, 'Directeur'],
            [37, 3, 'Directeur'],
            [38, 4, 'Directeur'],
            [39, 5, 'Directeur'],
            [41, 2, 'Directeur'],
            [42, 7, 'Directeur'],
            [43, 8, 'Directeur'],
            [44, 4, 'Directeur'],
        ];

        foreach ($movieActors as [$movieId, $artistId, $roleName]) {
            DB::table('artist_movie')->updateOrInsert(
                ['movie_id' => $movieId, 'artist_id' => $artistId],
                ['role_name' => $roleName]
            );
        }

        // Réactiver les contraintes
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
