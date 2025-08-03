<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;

class CreditCardResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random credit card information including type, number, expiration date, and owner name.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random credit card data using Faker. It includes fields such as type, number,
        expiration date, and owner name. The type of credit card is randomly selected from common types such as Visa,
        MasterCard, American Express, etc.';
    }

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
