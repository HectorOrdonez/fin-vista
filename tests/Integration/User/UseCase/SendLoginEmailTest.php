<?php

namespace Tests\Integration\User\UseCase;

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

class SendLoginEmailTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_stores_token_and_sends_it_to_the_users_email(): void
    {
        // Arrange
        $email = $this->faker->email;
        $user = UserFactory::create(['email' => $email]);
        $randomToken = 'random-token';
        Str::createRandomStringsUsing(fn() => $randomToken);

        $mailer = Mockery::mock(MailerInterface::class);
        $userRepository = app(UserRepositoryInterface::class);
        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);

        $mailer->shouldReceive('sendToken');

        $useCase = new SendLoginEmail($mailer, $userRepository, $loginTokenRepository);

        // Act
        $useCase($email);

        // Assert
        $this->assertDatabaseHas('login_tokens', [
            'user_id' => $user->id,
            'token' => $randomToken,
        ]);

        $mailer->shouldHaveReceived('sendToken')
            ->withArgs(function($user, $token) use($email, $randomToken) {
                $this->assertInstanceOf(User::class, $user);
                $this->assertInstanceOf(LoginToken::class, $token);

                $this->assertEquals($email, $user->email);
                $this->assertEquals($randomToken, $token->token);
                return true;
            });
    }

}
