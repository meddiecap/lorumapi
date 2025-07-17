<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;

class CreditCardResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'type'              => $this->faker->creditCardType(),
            'number'            => $this->faker->creditCardNumber(),
            'expiration'        => $this->faker->creditCardExpirationDateString(),
            'owner'             => $this->faker->firstName().' '.$this->faker->lastName(),
        ];
    }
}
