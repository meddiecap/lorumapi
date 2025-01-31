<?php

namespace App\Http\Resources;

use App\Http\Resources\Json\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => MovieResource::collection($this->collection),
            'links' => [
                'self' => url()->current(),
            ],
        ];
    }
}
