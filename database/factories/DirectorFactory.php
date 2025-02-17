<?php

namespace Database\Factories;

use App\Models\Director;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectorFactory extends Factory
{
    protected $model = Director::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'birth_date' => $this->faker->date,
        ];
    }
}
