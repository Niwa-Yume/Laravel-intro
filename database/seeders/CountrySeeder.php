<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        // Charge le tableau PHP généré dans database/dumps/countries_dump.php
        $countries = require database_path('dumps/countries_dump.php');

        // Sécurise l’insertion : on désactive puis réactive les clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($countries as $country) {
            // updateOrCreate garantit qu’on ne crée pas de doublons
            Country::updateOrCreate(
                ['id' => $country['id']],      // clé unique
                ['name' => $country['name']]   // champs à mettre à jour
            );
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
