<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns;

trait InteractsWithBaseUrl
{

    /**
     * Get the Base URL.
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        return config('services.walmartApi.base_url', 'https://marketplace.walmartapis.com');
    }
}
