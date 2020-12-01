<?php

namespace EolabsIo\WalmartApi\Tests\Unit;

use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Auth\Token;

class TokenTest extends TestCase
{
    public $token;


    public function setUp(): void
    {
        parent::setUp();

        $this->token = Token::create([
            'access_token' => '9eomyHRl2oSsFULKgv3kKeFQgqd8W',
            'token_type' => 'Bearer',
            'expires_in' => 900
            ]);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->token = null;
    }

    /** @test */
    public function it_can_create_token()
    {
        $this->assertEquals('9eomyHRl2oSsFULKgv3kKeFQgqd8W', $this->token->accessToken);
        $this->assertEquals('Bearer', $this->token->tokenType);
        $this->assertEquals(900, $this->token->expiresIn);

        $this->assertFalse($this->token->isExpired());
    }

    /** @test */
    public function it_can_add_token_detail()
    {
        $details = [
                "expire_at" => 1560973098000,
                "issued_at" => "1560972198000",
                "is_valid" => true,
                "scopes" => [
                    "reports" => "view_only",
                    "item" => "full_access",
                    "price" => "no_access",
                    "lagtime" => "full_access",
                    "feeds" => "view_only",
                    "returns" => "full_access",
                    "orders" => "full_access",
                    "inventory" => "full_access",
                    "content" => "full_access"
            ]];

        $this->token->setDetails($details);

        $this->assertEquals('Sat Apr 09 2005 06:20:00 GMT+0000', $this->token->expire_at->toString());
        $this->assertEquals('Tue Mar 29 2005 20:20:00 GMT+0000', $this->token->issued_at->toString());
        $this->assertTrue($this->token->is_valid);
        $this->assertNull($this->token->is_channel_match);
        $this->assertEquals('view_only', $this->token->scopes['reports']);
        $this->assertEquals('full_access', $this->token->scopes['orders']);
    }
}
