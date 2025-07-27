<?php

namespace App\Http\Resources\Faker;

use Faker\Generator as FakerGenerator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    protected FakerGenerator $faker;

    protected mixed $params;

    protected mixed $counter = 0;

    public function __construct(Request $request, FakerGenerator $faker, $params = null, $counter = 0)
    {
        parent::__construct($request);

        $this->faker = $faker;
        $this->params = $params;
        $this->counter = $counter;
    }
}
