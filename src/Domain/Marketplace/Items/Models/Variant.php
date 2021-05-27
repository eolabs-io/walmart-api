<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\VariantFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantMeta;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Variant extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public function variantMeta()
    {
        return $this->hasMany(VariantMeta::class);
    }


    public function variantData()
    {
        return $this->hasMany(VariantData::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return VariantFactory::new();
    }
}
