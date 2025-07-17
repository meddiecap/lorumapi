<?php

namespace App\Http\Resources\Faker;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $priceMin = $request->get('_price_min', 0.01);
        $priceMax = $request->get('_price_max');
        $taxes = $request->get('_taxes', 10);
        $categories_type = $request->get('_categories_type', 'integer'); // string, integer, uuid

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
                (new ImageResource($request, $this->faker))->resolve(),
                (new ImageResource($request, $this->faker))->resolve(),
                (new ImageResource($request, $this->faker))->resolve()
            ],
            'net_price' => $netPrice,
            'taxes' => $taxes,
            'price' => number_format($price, 2, '.', ''),
            'categories' => array_unique($categories),
            'tags' => $tags
        ];
    }
}
