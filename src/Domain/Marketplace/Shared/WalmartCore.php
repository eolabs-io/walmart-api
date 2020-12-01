<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Support\Facades\Auth;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\HasAuthHeaders;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\NextCursorable;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\InteractsWithBaseUrl;

abstract class WalmartCore
{
    use HasAuthHeaders,
        InteractsWithBaseUrl,
        NextCursorable;

    public function __construct()
    {
    }

    public function getUrl($endpoint = null): string
    {
        $endpoint = $endpoint ?? $this->getBranchUrl();

        return $this->getBaseUrl() . Str::start($endpoint, '/');
    }

    abstract public function getBranchUrl(): string;

    abstract public function fetch();

    public function get(string $endpoint = null, array $parameters = [])
    {
        try {
            $parameters = ($this->hasNextCursor()) ? array_merge($parameters, $this->getNextCursorParameter()) : $parameters;
            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->get($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function delete(string $endpoint = null, array $parameters = [])
    {
        try {
            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->delete($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function processResponse(Response $response)
    {
        $results = collect(json_decode($response->getBody(), true));
        $this->checkForNextCursor($results);

        return $results;
    }

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getHeaderFields(): array
    {
        return array_merge($this->getAuthTokenHeaders(), ['Accept' => 'application/json']);
    }

    protected function getAuthTokenHeaders(): array
    {
        return array_merge($this->getAuthHeaders(), $this->getTokenHeader());
    }

    protected function getTokenHeader(): array
    {
        return ['WM_SEC.ACCESS_TOKEN' => Auth::token()->accessToken];
    }

    protected function handleException(RequestException $requestException)
    {
        $status = $requestException->response->status();
        switch ($status) {
            default:
                throw $requestException;
        }
    }
}
