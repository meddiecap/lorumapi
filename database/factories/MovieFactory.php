<?php

namespace Database\Factories;

use App\Models\Director;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'release_year' => $this->faker->year,
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'genre_id' => Genre::factory(),
            'director_id' => Director::factory()
        ];
    }
}
