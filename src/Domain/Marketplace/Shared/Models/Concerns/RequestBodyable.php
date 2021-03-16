<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\Concerns;

use Illuminate\Support\Str;

trait RequestBodyable
{

    /**
     * Convert the model instance to the Request Body Schema:
     *
     * @return void
     */
    public function toRequestBody()
    {
        $itemsToRemove = $this->itemsToRemove();

        return collect($this->toArray())
                ->reject(function ($item, $key) use ($itemsToRemove) {
                    return in_array($key, $itemsToRemove);
                })
                ->mapWithKeys(function ($item, $key) {
                    return [Str::camel($key) => $item];
                })->toArray();
    }

    public function itemsToRemove(): array
    {
        return [
            'updated_at',
            'created_at',
            'id',
        ];
    }
}
