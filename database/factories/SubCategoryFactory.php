<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\SubCategory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_name' => $this->faker->text,
            'sub_category_id' => Str::random(10),
            'taxonomy_id' => Taxonomy::factory(),
        ];
    }
}
