<?php

namespace App\Http\Resources;

use App\Http\Resources\Json\DirectorResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DirectorCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => DirectorResource::collection($this->collection),
            'links' => [
                'self' => url()->current(),
            ],
        ];
    }
}
