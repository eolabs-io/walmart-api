<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\ImageFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Image extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'url',
                    'item_variant_id',
                ];

    public function itemVariant()
    {
        return $this->belongsTo(ItemVariant::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ImageFactory::new();
    }
}
