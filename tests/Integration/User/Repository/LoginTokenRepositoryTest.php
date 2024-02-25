<?php

namespace Tests\Integration\User\Repository;

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
}
