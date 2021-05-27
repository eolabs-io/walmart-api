<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\CategoryFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Category extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'property_id',
                ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return CategoryFactory::new();
    }
}
