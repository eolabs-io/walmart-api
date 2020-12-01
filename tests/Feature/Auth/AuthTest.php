<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Auth;
use EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token;
use EolabsIo\WalmartApi\Tests\Factories\AuthRequestFactory;

class AuthTest extends TestCase
{

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token */
    public $token;

    /** @var Carbon */
    public $knownDate;

    /** @var array */
    public $expected;


    public function setUp(): void
    {
        parent::setUp();

        $this->knownDate = Carbon::parse(1560972198000);
        Carbon::setTestNow($this->knownDate);

        AuthRequestFactory::new()->fakeResponse();

        $this->expected = $this->getExpectedResults();


        $this->token = $this->getToken();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Carbon::setTestNow();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {

        // Request for Token
        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Basic ' . $this->expected['accessToken']) &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('Content-Type', 'application/x-www-form-urlencoded') &&
                   $request->url() == 'https://marketplace.walmartapis.com/v3/token' &&
                   $request['grant_type'] == 'client_credentials';
        });

        // Request for Token Detail
        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Basic ' . $this->expected['accessToken']) &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->url() == 'https://marketplace.walmartapis.com/v3/token/detail';
        });
    }

    /** @test */
    public function it_can_get_a_valid_token()
    {
        // Token
        $this->assertEquals($this->expected['accessToken'], $this->token->accessToken);
        $this->assertEquals('Bearer', $this->token->tokenType);
        $this->assertEquals(900, $this->token->expiresIn);
        $this->assertFalse($this->token->isExpired());

        // TokenDetail
        $this->assertEquals('Sat Apr 09 2005 06:20:00 GMT+0000', $this->token->expire_at->toString());
        $this->assertEquals('Tue Mar 29 2005 20:20:00 GMT+0000', $this->token->issued_at->toString());
        $this->assertTrue($this->token->is_valid);
        $this->assertNull($this->token->is_channel_match);
        $this->assertEquals('view_only', $this->token->scopes['reports']);
        $this->assertEquals('full_access', $this->token->scopes['orders']);
    }

    /** @test */
    public function it_can_get_a_new_token_after_expiration()
    {
        // Token
        $this->assertEquals($this->expected['accessToken'], $this->token->accessToken);
        $this->assertEquals('Bearer', $this->token->tokenType);
        $this->assertEquals(900, $this->token->expiresIn);
        $this->assertFalse($this->token->isExpired());

        // Set current time to now
        Carbon::setTestNow();
        $this->assertTrue($this->token->isExpired());
        $this->token = $this->getToken();

        $this->assertEquals($this->expected['accessToken2'], $this->token->accessToken);
    }

    private function getToken(): Token
    {
        return Auth::token();
    }

    private function getExpectedResults(): array
    {
        return [
            'accessToken' => 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0',
            'accessToken2' => 'FZzQS15YroOmSepsYlhZ5MtlhVRAWZth',
        ];
    }
}
