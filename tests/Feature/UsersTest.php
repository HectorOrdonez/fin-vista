<?php

namespace Tests\Feature;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_sees_registration_page(): void
    {
        // Arrange
        // Act
        $response = $this->get('users/create');

        // Assert
        $response
            ->assertStatus(200)
            ->assertSee('registration page');
    }

    /** @test */
    public function a_user_gets_an_email_when_successfully_registering(): void
    {
        // Arrange
        $email = $this->faker->safeEmail;

        $mailer = Mockery::mock(MailerInterface::class);
        $mailer->shouldReceive('sendToken');

        app()->bind(MailerInterface::class, fn() => $mailer);

        // Act
        $response = $this->post('/users', ['email' => $email]);

        // Assert
        $response->assertStatus(302); // redirect status is controversial
        $mailer->shouldHaveReceived('sendToken')
            ->withArgs(function ($user, $token) use ($email) {
                $this->assertInstanceOf(User::class, $user);
                $this->assertInstanceOf(LoginToken::class, $token);

                $this->assertEquals($user->email, $email);

                return true;
            });
    }
}
