<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Token
{
    /** @var string */
    private $accessToken;

    /** @var string */
    private $tokenType;

    /** @var int */
    private $expiresIn;

    /** @var Illuminate\Support\Carbon */
    private $expire_at;

    /** @var Illuminate\Support\Carbon */
    private $issued_at;

    /** @var bool */
    private $is_valid;

    /** @var bool */
    private $is_channel_match;

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [];

    public function __construct(string $accessToken, string $tokenType, int $expiresIn)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;

        $this->expire_at = Carbon::now()->addSeconds($this->expiresIn);
    }

    public static function create(array $params): self
    {
        $accessToken = Arr::get($params, 'access_token');
        $tokenType = Arr::get($params, 'token_type');
        $expiresIn = Arr::get($params, 'expires_in', -900);

        return new self($accessToken, $tokenType, $expiresIn);
    }

    public function setDetails($params): self
    {
        if (Arr::has($params, 'expire_at')) {
            $this->expire_at = Carbon::parse((int) Arr::get($params, 'expire_at'));
        }

        if (Arr::has($params, 'issued_at')) {
            $this->issued_at = Carbon::parse((int) Arr::get($params, 'issued_at'));
        }

        $this->is_valid = Arr::get($params, 'is_valid');
        $this->is_channel_match = Arr::get($params, 'is_channel_match');
        $this->scopes = Arr::get($params, 'scopes', []);

        return $this;
    }

    public function isExpired(): bool
    {
        return $this->expire_at->isPast();
    }

    public function isNotExpired(): bool
    {
        return ! $this->isExpired();
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
