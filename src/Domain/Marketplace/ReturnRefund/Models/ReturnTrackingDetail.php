<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Database\Factories\ReturnTrackingDetailFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;

class ReturnTrackingDetail extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'event_time' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'sequence_no',
                    'event_tag',
                    'event_description',
                    'event_time',
                ];

    protected $hidden = ['pivot'];


    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReturnTrackingDetailFactory::new();
    }
}
