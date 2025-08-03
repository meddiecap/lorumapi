<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

class AddressResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return '
            Generates random addresses with street, house number, city, state, region, postcode, country, county code,
            latitude, and longitude.';
    }

    public static function longDescription(): string
    {
        return '
            This resource generates random addresses using Faker. It includes fields such as street, house number,
            city, state, region, postcode, country, county code, latitude, and longitude. The country can be specified
            using the `country` parameter, and the locale can be set using the `locale` parameter.';
    }

    public static function availableParams(): array
    {
        $params = parent::availableParams();

        return array_merge($params, [
            'country' => [
                'name' => 'country',
                'type' => 'string',
                'description' => 'The country code (ISO 3166-1 alpha-2) to generate the address for.',
                'example' => 'US',
            ],
            'locale' => [
                'name' => 'locale',
                'type' => 'string',
                'description' => 'The locale to use for generating the address.',
                'example' => 'en_US',
            ],
        ]);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $countries = $this->getCountries();

        $streetName = $this->faker->streetName();
        $houseNumber = $this->faker->numberBetween(1, 200);
        $country = $this->faker->randomElement($countries);

        $output = [
            'id'                => $this->counter,
            'street'            => $streetName . ' ' . $houseNumber,
            'street_name'       => $streetName,
            'house_number'      => $houseNumber,
            'building_number'   => $this->faker->buildingNumber(),
            'city'              => $this->faker->city(),
        ];

        // check if state method exists in Faker, e.g. fr_FR locale does not have state method
        if (method_exists($this->faker, 'state')) {
            $output['state'] = $this->faker->state();
        }

        // check if region method exists in Faker, e.g. en_US locale does not have region method
        if (method_exists($this->faker, 'region')) {
            $output['region'] = $this->faker->region();
        }

        if (isset($this->params['country']) && $this->params['country'] !== null) {
            $country['name'] = Countries::getName($this->params['country'], $this->params['locale']);
            $country['code'] = $this->params['country'];
        }

        return array_merge($output, [
            'postcode'          => $this->faker->postcode(),
            'country'           => $country['name'],
            'county_code'       => $country['code'],
            'latitude'          => $this->faker->latitude(),
            'longitude'         => $this->faker->longitude()
        ]);
    }
}
