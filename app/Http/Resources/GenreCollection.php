<?php

namespace App\Http\Resources;

use App\Http\Resources\Json\GenreResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GenreCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => GenreResource::collection($this->collection),
            'links' => [
                'self' => url()->current(),
            ],
        ];
    }
}
