<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\SubCategoryFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class SubCategory extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'sub_category_name',
                    'sub_category_id',
                    'taxonomy_id'
                ];

    public function subcategory()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return SubCategoryFactory::new();
    }
}
