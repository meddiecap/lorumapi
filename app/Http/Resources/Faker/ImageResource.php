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
        $width = (@$request->_width && $request->_width != '') ? $request->_width : null;
        $height = (@$request->_height && $request->_height != '') ? $request->_height : null;

        // Use a random name as a seed for image generation
        $imageTitle = $this->faker->text(30);

        $x = $width ?? '640';
        $y = $height ?? '480';
        $url = 'https://picsum.photos/seed/' . Str::slug($imageTitle) . '/' . $x . '/' . $y;

        return [
            'title'         => $imageTitle,
            'description'   => $this->faker->text(),
            'url'           => $url,
        ];
    }
}
