<?php

namespace Database\Factories;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName,
            'firstname' => $this->faker->firstname,
            'birthdate' => $this->faker->numberBetween(1901, 2010),
            'country_id' => Country::all()->random()->id
        ];
    }
}
