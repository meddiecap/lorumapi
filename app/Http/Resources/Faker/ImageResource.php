<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random images with a title, description, and URL.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random image data using Faker. It includes fields such as title, description,
        and URL. The image URL is generated based on a random title to ensure uniqueness. The width and height of the
        image can be specified using the `width` and `height` parameters in the request.';
    }

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
