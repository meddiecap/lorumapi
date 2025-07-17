<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyResource extends BaseResource
{
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
            $addresses[] = (new AddressResource($request, $this->faker))->resolve();
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
            'contact'       => (new PersonResource($request, $this->faker))->resolve(),
        ];
    }
}
