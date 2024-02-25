<?php

namespace Tests\Integration\User\UseCase;

use FinVista\User\Application\UseCase\CreateUser;
use FinVista\User\Application\UseCase\SendLoginEmail;
use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\User;
use FinVista\User\Domain\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Mockery;
use Tests\Support\UserFactory;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_stores_user_and_sends_logging_email(): void
    {
        // Arrange
        $createUser = new CreateUser();

        $mailer = $this->createMock(MailerInterface::class);
        $mailer->shouldReceive('sendToken');

        // Act
        $createUser($email);

        // Assert
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
        $mailer->shouldHaveReceived('sendToken')
            ->withArgs(function($user, $token) use ($email) {
                $this->assertInstanceOf(User::class, $user);
                $this->assertInstanceOf(LoginToken::class, $token);

                $this->assertEquals($email, $user->email);
                $this->assertEquals($user->id, $token->userId);

                return true;
            });

    }
}
