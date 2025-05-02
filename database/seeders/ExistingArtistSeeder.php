<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;

class ExistingArtistSeeder extends Seeder
{
    public function run(): void
    {
        // 1. On récupère le tableau généré par le dump
        $artists = include database_path('dumps/artists_dump.php');

        // 2. On insère tout d’un coup (plus rapide que create() en boucle)
        //    Attention : les colonnes du dump doivent correspondre
        //    à celles qui sont déclarées « fillable » ou « guarded » dans le modèle Artist
        Artist::insert($artists);
    }
}
