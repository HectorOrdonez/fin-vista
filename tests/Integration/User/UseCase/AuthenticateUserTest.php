<?php

namespace Tests\Integration\User\UseCase;

use FinVista\User\Application\UseCase\AuthenticateUser;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use FinVista\User\Domain\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\LoginTokenFactory;
use Tests\Support\UserFactory;
use Tests\TestCase;

class AuthenticateUserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_authenticates_when_token_exists(): void
    {
        // Arrange
        $token      = 'some-random-token';
        $user       = UserFactory::create();
        LoginTokenFactory::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        $userRepository = app(UserRepositoryInterface::class);

        $authenticateUser = new AuthenticateUser($userRepository, $loginTokenRepository);

        // Act
        $authenticateUser($token);

        // Assert
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_deletes_token_after_authentication(): void
    {
        // Arrange
        $token      = 'some-random-token';
        $user       = UserFactory::create();
        LoginTokenFactory::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        $userRepository = app(UserRepositoryInterface::class);

        $authenticateUser = new AuthenticateUser($userRepository, $loginTokenRepository);

        // Act
        $authenticateUser($token);

        // Assert
        $this->assertDatabaseMissing('login_tokens', [
            'token' => $token,
        ]);
    }
}
