<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Locales;

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
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
//        $language = Languages::getName($this->params['locale']);
//        $locale = Locales::getName($this->params['locale']);
//        $country = Countries::getName('GB', 'de');
//        dd($language, $locale);

        $output = [
            'id'                => $this->counter,
            'street'            => $this->faker->streetAddress(),
            'street_name'       => $this->faker->streetName(),
            'house_number'      => $this->faker->buildingNumber(),
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
            $countries = Countries::getNames($this->params['locale']);
            $countryName = Countries::getName($this->params['country'], $this->params['locale']);
            $countryLocalName = Countries::getName($this->params['country']);
            dd($this->params['locale'], $countryName, $countryLocalName);
            $countryCode = $this->faker->countryCode($this->params['country']);
        } else {
            $country = $this->faker->country();
            $countryCode = $this->faker->countryCode();
        }

        return array_merge($output, [
            'postcode'          => $this->faker->postcode(),
            'country'           => $country,
            'county_code'       => $countryCode,
            'latitude'          => $this->faker->latitude(),
            'longitude'         => $this->faker->longitude()
        ]);
    }
}
