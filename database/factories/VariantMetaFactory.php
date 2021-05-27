<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantMeta;

class VariantMetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantMeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'variant_id' => Variant::factory(),
        ];
    }
}
