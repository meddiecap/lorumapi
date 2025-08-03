<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return '
            Generates random companies with name, email, VAT number, phone number, country, addresses, website, image URL,
            address and contact person.';
    }

    public static function longDescription(): string
    {
        return '
            This resource generates random company data using Faker. It includes fields such as name, email, VAT number,
            phone number, country, addresses, website, image URL, and contact person. The image URL is generated based on
            the company name to ensure uniqueness.';
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $addresses = [];
        $n_addresses = rand(1, 5);
        for ($i=0; $i < $n_addresses; $i++) {
            $addresses[] = new AddressResource($request, $this->faker, $this->params, $i+1)->resolve();
        }

        // Use company name as a seed for image generation
        $name = $this->faker->company();

        return [
            'id'            => $this->counter,
            'name'          => $name,
            'email'         => $this->faker->email(),
            'vat'           => $this->faker->regexify('[0-9]{'.rand(8,11).'}'),
            'phone'         => $this->faker->e164PhoneNumber(),
            'country'       => $this->faker->country(),
            'addresses'     => $addresses,
            'website'       => 'https://'.$this->faker->domainName(),
            'image'         => 'https://picsum.photos/seed/' . Str::slug($name) . '/480/640',
            'contact'       => new PersonResource($request, $this->faker, $this->params, 1)->resolve(),
        ];
    }
}
