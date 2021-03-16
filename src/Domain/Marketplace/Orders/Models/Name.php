<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\NameFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Name extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'empty' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'complete_name',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'general_suffix',
                    'maturity_suffix',
                    'title_of_respect',
                    'empty',
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return NameFactory::new();
    }
}
