<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductResource extends BaseResource
{
    /**
     * A description of the resource used for the documentation page of this resource.
     *
     * @return string
     */
    public static function description(): string
    {
        return 'Generates random products with name, description, EAN, UPC, image URL, net price, taxes, price, categories,
        and tags.';
    }

    public static function longDescription(): string
    {
        return 'This resource generates random product data using Faker. It includes fields such as name, description,
        EAN, UPC, image URL, net price, taxes, price, categories, and tags. The image URL is generated based on the
        product name to ensure uniqueness.';
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $priceMin = $this->params["price_min"] ?? 0.01;
        $priceMax = $this->params["price_min"] ?? null;
        $taxes = $this->params["taxes"] ?? 10;
        $categories_type = $this->params["categories_type"] ?? 'integer'; // string, integer, uuid

        $netPrice = $this->faker->randomFloat(2, $priceMin, $priceMax);
        $price = $netPrice * (1 + ($taxes / 100));

        $categories = [];
        $n_categories = rand(1, 10);

        for ($i=0; $i < $n_categories; $i++) {
            $categories[] = match ($categories_type) {
                'string' => $this->faker->word(),
                'integer' => $this->faker->randomDigitNotNull(),
                'uuid' => $this->faker->uuid(),
                default => 'integer'
            };
        }

        $tags = [];
        $n_tags = rand(1, 10);
        for ($i=0; $i < $n_tags; $i++) {
            $tags[] = $this->faker->word();
        }

        // Use product name as a seed for image generation
        $productName = $this->faker->text(30);

        return [
            'id'            => $this->counter,
            'name'          => $productName,
            'description'   => $this->faker->text(),
            'ean'           => $this->faker->ean13(),
            'upc'           => $this->faker->regexify('[0-9]{12}'),
            'image'         => 'https://picsum.photos/seed/' . Str::slug($productName) . '/640/480',
            'images'        => [
                (new ImageResource($request, $this->faker, $this->params))->resolve(),
                (new ImageResource($request, $this->faker, $this->params))->resolve(),
                (new ImageResource($request, $this->faker, $this->params))->resolve()
            ],
            'net_price' => $netPrice,
            'taxes' => $taxes,
            'price' => number_format($price, 2, '.', ''),
            'categories' => array_unique($categories),
            'tags' => $tags
        ];
    }
}
