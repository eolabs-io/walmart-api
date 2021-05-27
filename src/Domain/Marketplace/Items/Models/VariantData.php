<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\VariantDataFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantValue;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class VariantData extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'variant_id',
        'product_image_url',
        'item_id',
        'is_available',
        'title',
    ];


    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function variantValues()
    {
        return $this->hasMany(VariantValue::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return VariantDataFactory::new();
    }
}
