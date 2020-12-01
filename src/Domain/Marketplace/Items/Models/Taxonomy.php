<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\TaxonomyFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\SubCategory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Taxonomy extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'category',
                ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TaxonomyFactory::new();
    }
}
