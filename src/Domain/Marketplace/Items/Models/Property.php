<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\PropertyFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Category;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Property extends WalmartModel
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'next_day_eligible' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'variant_items_num',
                    'num_reviews',
                    'next_day_eligible',
                    'variant_id',
                ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PropertyFactory::new();
    }
}
