<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns;

use Illuminate\Support\Str;

trait HasAuthHeaders
{

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getAuthHeaders(): array
    {
        return [
                'Authorization' => 'Basic '.base64_encode($this->getClientId().":".$this->getClientSecret()),
                'WM_QOS.CORRELATION_ID' => (string) Str::uuid(),
                'WM_SVC.NAME' => 'Walmart Marketplace',
            ];
    }

    /**
     * Get the Client Id.
     *
     * @return string
     */
    private function getClientId(): string
    {
        return config('walmart.client_id');
    }

    /**
     * Get the Client Secret.
     *
     * @return string
     */
    private function getClientSecret(): string
    {
        return config('walmart.client_secret');
    }
}
