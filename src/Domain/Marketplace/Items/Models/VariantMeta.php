<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\VariantMetaFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class VariantMeta extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'variant_id',
    ];


    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return VariantMetaFactory::new();
    }
}
