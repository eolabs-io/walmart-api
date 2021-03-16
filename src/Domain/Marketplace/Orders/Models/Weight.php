<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\WeightFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Weight extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'value',
                    'unit',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return WeightFactory::new();
    }
}
