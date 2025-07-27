<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Use a random name as a seed for image generation
        $imageTitle = $this->faker->text(30);

        $x = $request->get('width', 640);
        $y = $request->get('height', 480);
        $url = 'https://picsum.photos/seed/' . Str::slug($imageTitle) . '/' . $x . '/' . $y;

        return [
            'title'         => $imageTitle,
            'description'   => $this->faker->text(),
            'url'           => $url,
        ];
    }
}
