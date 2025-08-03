<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;

class TextResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random text content with a title, author, genre, and content.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random text content using Faker. It includes fields such as title, author, genre,
        and content. The title is generated as a real text string, and the content is a longer text block.';
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $characters = $this->params['characters'] ?? 200;

        return [
            'title'         => $this->faker->realText(20),
            'author'        => $this->faker->firstName().' '.$this->faker->lastName(),
            'genre'         => ucfirst($this->faker->word()),
            'content'       => $this->faker->realText($characters)
        ];
    }
}
