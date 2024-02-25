<?php

namespace Tests\Integration\User\Repository;

use FinVista\User\Domain\Exception\LoginTokenNotFound;
use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\LoginTokenFactory;
use Tests\Support\UserFactory;
use Tests\TestCase;

class LoginTokenRepositoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function create_creates_a_token_and_returns_its_id(): void
    {
        // Arrange
        $userId     = UserFactory::create()->id;
        $token      = 'some-random-token';
        $loginToken = LoginTokenFactory::make([
            'user_id' => $userId,
            'token' => $token,
        ]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        assert($loginTokenRepository instanceof LoginTokenRepositoryInterface);

        // Act
        $id = $loginTokenRepository->create($loginToken);

        // Assert
        $this->assertDatabaseHas('login_tokens', [
            'id' => $id,
            'token' => $loginToken->token,
        ]);
    }

    /** @test */
    public function findByToken_returns_token_when_token_exists(): void
    {
        // Arrange
        $token = 'some-random-token';
        $user  = UserFactory::create();
        LoginTokenFactory::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        assert($loginTokenRepository instanceof LoginTokenRepositoryInterface);

        // Act
        $loginToken = $loginTokenRepository->findByToken($token);

        // Assert
        $this->assertInstanceOf(LoginToken::class, $loginToken);
        $this->assertEquals($token, $loginToken->token);
    }

    /** @test */
    public function findByToken_throws_exception_when_token_does_not_match(): void
    {
        // Arrange
        $validToken = 'valid-token';
        $missingToken = 'missing-token';
        $user  = UserFactory::create();
        LoginTokenFactory::create([
            'user_id' => $user->id,
            'token' => $validToken,
        ]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        assert($loginTokenRepository instanceof LoginTokenRepositoryInterface);

        // Assert
        $this->expectException(LoginTokenNotFound::class);

        // Act
        $loginTokenRepository->findByToken($missingToken);
    }

    /** @test */
    public function delete_deletes_token(): void
    {
        // Arrange
        $user       = UserFactory::create();
        $loginToken = LoginTokenFactory::create(['user_id' => $user->id]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        assert($loginTokenRepository instanceof LoginTokenRepositoryInterface);

        // Act
        $loginTokenRepository->delete($loginToken);

        // Assert
        $this->assertDatabaseMissing('login_tokens', [
            'token' => $loginToken->token,
        ]);
    }

}
