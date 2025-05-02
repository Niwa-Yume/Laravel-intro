<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\Movie;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des cinémas de Genève avec leurs adresses
        $cinemas = [
            [
                'name' => 'Cinéma Pathé Genève',
                'address' => 'Rue du Marché 15, 1204 Genève',
                'rooms' => [
                    ['name' => 'Salle IMAX', 'capacity' => 250],
                    ['name' => 'Salle 2', 'capacity' => 180],
                ]
            ],
            [
                'name' => 'Pathé Balexert',
                'address' => 'Avenue Louis-Casaï 27, 1209 Genève',
                'rooms' => [
                    ['name' => 'Salle 1', 'capacity' => 320],
                    ['name' => 'Salle 2', 'capacity' => 280],
                    ['name' => 'Salle 3', 'capacity' => 200],
                    ['name' => 'Salle 4D', 'capacity' => 150],
                ]
            ],
            [
                'name' => 'Arena Cinémas La Praille',
                'address' => 'Route des Jeunes 10, 1227 Carouge',
                'rooms' => [
                    ['name' => 'Salle Premium', 'capacity' => 280],
                    ['name' => 'Salle VIP', 'capacity' => 120],
                    ['name' => 'Salle 3', 'capacity' => 180],
                ]
            ],
            [
                'name' => 'Cinéma Rex',
                'address' => 'Rue de la Confédération 8, 1204 Genève',
                'rooms' => [
                    ['name' => 'Grande Salle', 'capacity' => 300],
                    ['name' => 'Petite Salle', 'capacity' => 150],
                ]
            ],
            [
                'name' => 'Cinéma Bio',
                'address' => 'Rue Saint-Joseph 47, 1227 Carouge',
                'rooms' => [
                    ['name' => 'Salle Principale', 'capacity' => 200],
                ]
            ],
            [
                'name' => 'Cinélux',
                'address' => 'Boulevard de Saint-Georges 8, 1205 Genève',
                'rooms' => [
                    ['name' => 'Salle Unique', 'capacity' => 160],
                ]
            ],
            [
                'name' => 'Les Scala',
                'address' => 'Rue des Eaux-Vives 23, 1207 Genève',
                'rooms' => [
                    ['name' => 'Salle 1', 'capacity' => 190],
                    ['name' => 'Salle 2', 'capacity' => 140],
                ]
            ],
        ];

        // Récupération de films existants pour les séances
        $movies = Movie::take(3)->get();


        // Création des cinémas avec leurs salles et séances
        foreach ($cinemas as $cinemaData) {
            $cinema = Cinema::create([
                'name' => $cinemaData['name'],
                'address' => $cinemaData['address'],
            ]);

            // Création des salles pour chaque cinéma
            foreach ($cinemaData['rooms'] as $roomData) {
                $room = $cinema->rooms()->create([
                    'name' => $roomData['name'],
                    'capacity' => $roomData['capacity'],
                ]);

                // Création de séances pour chaque salle
                foreach ($movies as $index => $movie) {
                    $room->showtimes()->create([
                        'movie_id' => $movie->id,
                        'start_time' => now()->addDays($index + 1)->setHour(19 + $index)->setMinute(0),
                    ]);
                }
            }
        }
    }
}
