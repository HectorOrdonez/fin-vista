<?php

namespace Tests\Integration\User\Repository;

use FinVista\User\Domain\Exception\UserAlreadyExists;
use FinVista\User\Domain\Exception\UserNotFound;
use FinVista\User\Domain\User;
use FinVista\User\Domain\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\UserFactory;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function create_creates_a_user_and_returns_its_id(): void
    {
        // Arrange
        $email          = $this->faker->email;
        $user           = UserFactory::make(['email' => $email]);
        $userRepository = app(UserRepositoryInterface::class);
        assert($userRepository instanceof UserRepositoryInterface);

        // Act
        $id = $userRepository->create($user);

        // Assert
        $this->assertDatabaseHas('users', [
            'id' => $id,
            'email' => $email,
        ]);
    }

    /** @test */
    public function create_throws_exception_when_user_exists(): void
    {
        // Arrange
        $email          = $this->faker->email;
        $user           = UserFactory::create(['email' => $email]);
        $userRepository = app(UserRepositoryInterface::class);
        assert($userRepository instanceof UserRepositoryInterface);

        $this->expectException(UserAlreadyExists::class);

        $userRepository->create($user);
    }

    /** @test */
    public function findByEmail_returns_user_when_it_exists(): void
    {
        // Arrange
        $email          = $this->faker->email;
        UserFactory::create(['email' => $email]);

        $userRepository = app(UserRepositoryInterface::class);
        assert($userRepository instanceof UserRepositoryInterface);

        // Act
        $foundUser = $userRepository->findByEmail($email);

        // Assert
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($email, $foundUser->email);
    }

    /** @test */
    public function findByEmail_throws_exception_when_user_does_not_exist(): void
    {
        // Arrange
        $userRepository = app(UserRepositoryInterface::class);
        assert($userRepository instanceof UserRepositoryInterface);

        // Assert
        $this->expectException(UserNotFound::class);

        // Act
        $userRepository->findByEmail('unknown@email.com');
    }
}
