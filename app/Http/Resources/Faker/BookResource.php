<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random books with title, author, genre, description, ISBN, image URL, published date, and
        publisher.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random book data using Faker. It includes fields such as title, author, genre,
        description, ISBN, image URL, published date, and publisher. The image URL is generated based on the title to
        ensure uniqueness.';
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Use title as a seed for image generation
        $title = $this->faker->realText(20);

        return [
            'id'            => $this->counter,
            'title'         => $title,
            'author'        => $this->faker->firstName().' '.$this->faker->lastName(),
            'genre'         => ucfirst($this->faker->word()),
            'description'   => $this->faker->realText(200),
            'isbn'          => $this->faker->isbn13(),
            'image'         => 'https://picsum.photos/seed/' . Str::slug($title) . '/480/640',
            'published'     => $this->faker->date(),
            'publisher'     => ucfirst($this->faker->word()).' '.ucfirst($this->faker->word())
        ];
    }
}
