<?php
namespace App\Services;

use Faker\Factory;
use Faker\Generator as FakerGenerator;

class FakerManager
{
    /** @var FakerGenerator */
    protected $faker;

    public function __construct(string $locale = 'en_US')
    {
        // Create the Faker‑generator
        $this->faker = Factory::create($locale);
    }

    /**
     * Send all method calls to the Faker‑generator.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        return $this->faker->$method(...$args);
    }

    /**
     * Get a list of available locales for Faker.
     *
     * @return array
     */
    public function getLocales(): array
    {
        $ref = new \ReflectionClass(FakerGenerator::class);
        $providerDir = dirname($ref->getFileName()) . '/Provider/';

        return collect(scandir($providerDir))
            ->filter(fn($item) => is_dir($providerDir.$item) && ! in_array($item, ['.', '..']))
            ->values()
            ->toArray();
    }
}
