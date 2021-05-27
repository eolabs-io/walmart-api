<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Image;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'item_variant_id' => ItemVariant::factory(),
        ];
    }
}
