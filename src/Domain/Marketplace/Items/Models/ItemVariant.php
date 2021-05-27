<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\ItemVariantFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Image;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class ItemVariant extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_market_place_item' => 'boolean',
        'free_shipping' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'item_id',
                    'upc',
                    'gtin',
                    'is_market_place_item',
                    'customer_rating',
                    'free_shipping',
                    'offer_count',
                    'price_id',
                    'description',
                    'title',
                    'brand',
                    'product_type',
                    'property_id',
                ];

    public function price()
    {
        return $this->belongsTo(Price::class)->withDefault();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ItemVariantFactory::new();
    }
}
