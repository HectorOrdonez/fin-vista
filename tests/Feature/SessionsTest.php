<?php

namespace Tests\Feature;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\Support\LoginTokenFactory;
use Tests\Support\UserFactory;
use Tests\TestCase;

class SessionsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function a_user_can_visit_the_login_page(): void
    {
        // Arrange
        // Act
        $response = $this->get('/sessions/create');

        // Assert
        $response
            ->assertStatus(200)
            ->assertSee('login page');
    }

    /** @test */
    public function a_user_gets_an_email_when_successfully_logging_in(): void
    {
        // Arrange
        $email       = $this->faker->safeEmail;
        $createdUser = UserFactory::create(['email' => $email]);

        $mailer = Mockery::mock(MailerInterface::class);
        $mailer->shouldReceive('sendToken');

        app()->bind(MailerInterface::class, fn() => $mailer);

        // Act
        $response = $this->post('/sessions', ['email' => $email]);

        // Assert
        $response->assertStatus(302); // redirect status is controversial
        $mailer->shouldHaveReceived('sendToken')
            ->withArgs(function ($user, $token) use ($createdUser) {
                $this->assertInstanceOf(User::class, $user);
                $this->assertInstanceOf(LoginToken::class, $token);

                $this->assertEquals($user->email, $createdUser->email);
                $this->assertEquals($token->userId, $createdUser->id);

                return true;
            });
    }

    /** @test */
    public function a_user_authenticates_with_a_login_token(): void
    {
        // Arrange
        $user = UserFactory::create();
        $loginToken = LoginTokenFactory::create(['user_id' => $user->id]);

        // Act
        $response = $this->get('/sessions/auth?token=' . $loginToken->token);

        // Assert
        $response
            ->assertStatus(200)
            ->assertSee('You have logged in');
    }

}
