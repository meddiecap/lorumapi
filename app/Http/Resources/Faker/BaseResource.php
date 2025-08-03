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

    /**
     * A description of the resource used for the documentation page of this resource.
     * @return string
     */
    abstract public static function description(): string;

    /**
     * A long description of the resource used for the documentation page of this resource.
     * @return string
     */
    abstract public static function longDescription(): string;

    public static function availableParams(): array
    {
        return [
            'locale' => [
                'name' => 'locale',
                'type' => 'string',
                'default' => 'en_US',
                'example' => 'en_US',
                'description' => 'The locale to use for generating data. Defaults to "en_US".',
            ],
            'quantity' => [
                'name' => 'quantity',
                'type' => 'integer',
                'default' => 10,
                'example' => 10,
                'description' => 'Number of fake records to generate. Defaults to 10, maximum is 1000.',
            ],
            'seed' => [
                'name' => 'seed',
                'type' => 'integer',
                'default' => null,
                'example' => 12345,
                'description' => 'Seed value for reproducible results. If not provided, a random seed will be used.',
            ],
        ];
    }

    /**
     * Get a list of countries with their names and codes.
     * @return array
     */
    protected function getCountries(): array
    {
        return cache()->remember('faker.countries.' . $this->params['locale'], 60 * 60, function () {
            return collect(\Symfony\Component\Intl\Countries::getNames($this->params['locale']))
                ->map(function ($country, $code) {
                    return [
                        'name' => $country,
                        'code' => $code,
                    ];
                })->all();
        });
    }
}
