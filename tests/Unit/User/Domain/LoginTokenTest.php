<?php

namespace Tests\Unit\User\Domain;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class LoginTokenTest extends TestCase
{
    /** @test */
    public function generateFor_returns_LoginToken_with_randomly_generated_token(): void
    {
        // Arrange
        $randomToken = 'this-is-a-random-token';
        Str::createRandomStringsUsing(fn() => $randomToken);

        $userMock = $this->createMock(User::class);
        $userMock->id = random_int(1, 10000);

        // Act
        $loginToken = LoginToken::generateFor($userMock);

        // Assert
        $this->assertInstanceOf(LoginToken::class, $loginToken);
        $this->assertEquals($randomToken, $loginToken->token);
    }

}
