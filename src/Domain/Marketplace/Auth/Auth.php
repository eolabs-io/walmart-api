<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\HasAuthHeaders;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\InteractsWithBaseUrl;

class Auth
{
    use HasAuthHeaders,
        InteractsWithBaseUrl;

    /**
     * The cached Token instance.
     *
     * @var EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token|null
     */
    protected $token;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the token URL.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return $this->getBaseUrl() . '/v3/token';
    }

    /**
     * Get the token detail URL.
     *
     * @return string
     */
    protected function getTokenDetailUrl()
    {
        return $this->getBaseUrl() . '/v3/token/detail';
    }


    /**
     * Get the current token or new one.
     *
     * @return EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token
     */
    public function token()
    {
        if (optional($this->token)->isNotExpired()) {
            return $this->token;
        }

        $accessTokenResponse = $this->getAccessTokenResponse();
        $accessTokenDetailResponse = $this->getAccessTokenDetailResponse();

        $this->token = Token::create($accessTokenResponse)->setDetails($accessTokenDetailResponse);

        return $this->token;
    }

    /**
     * Get the access token response.
     *
     * @return array
     */
    public function getAccessTokenResponse()
    {
        try {
            $response = Http::withHeaders($this->getHeaderFields())
                        ->asForm()
                        ->post($this->getTokenUrl(), [
                                'grant_type' => 'client_credentials',
                            ])->throw();

            return json_decode($response->getBody(), true);
        } catch (RequestException $exception) {
            dd('getAccessTokenResponse()', $exception);
        }
    }

    /**
     * Get the access token detail response.
     *
     * @return array
     */
    public function getAccessTokenDetailResponse()
    {
        $response = Http::withHeaders($this->getHeaderFields())
                        ->get($this->getTokenDetailUrl());

        return json_decode($response->getBody(), true);
    }

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getHeaderFields(): array
    {
        return array_merge($this->getAuthHeaders(), ['Accept' => 'application/json']);
    }
}
