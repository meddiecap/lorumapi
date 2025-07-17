<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;

class TextResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $characters = $request->get('_characters', 200);

        return [
            'title'         => $this->faker->realText(20),
            'author'        => $this->faker->firstName().' '.$this->faker->lastName(),
            'genre'         => ucfirst($this->faker->word()),
            'content'       => $this->faker->realText($characters)
        ];
    }
}
