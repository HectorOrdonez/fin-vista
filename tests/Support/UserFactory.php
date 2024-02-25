<?php

namespace Tests\Support;

use FinVista\User\Domain\User;
use FinVista\User\Domain\UserRepositoryInterface;

class UserFactory
{
    public static function make($overridingAttributes = []): User
    {
        $attributes = array_merge(self::getDefaults(), $overridingAttributes);

        $user = new User();

        $user->email = $attributes['email'];

        return $user;
    }

    public static function create($overridingAttributes = []): User
    {
        $user = self::make($overridingAttributes);

        $userRepository = app(UserRepositoryInterface::class);
        $userRepository->create($user);

        return $user;
    }

    private static function getDefaults(): array
    {
        return [
            'email' => 'some@email.com',
        ];
    }
}
