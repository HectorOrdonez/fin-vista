<?php

namespace Tests\Support;


use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use Illuminate\Support\Str;

class LoginTokenFactory
{
    public static function make($overridingAttributes = []): LoginToken
    {
        $attributes = array_merge(self::getDefaults(), $overridingAttributes);

        $loginToken         = new LoginToken();
        $loginToken->userId = $attributes['user_id'];
        $loginToken->token  = $attributes['token'];

        return $loginToken;
    }

    public static function create($overridingAttributes = []): LoginToken
    {
        $loginToken = self::make($overridingAttributes);

        $loginTokenRepository = app(LoginTokenRepositoryInterface::class);
        $loginTokenRepository->create($loginToken);

        return $loginToken;
    }

    private static function getDefaults(): array
    {
        return [
            'user_id' => random_int(1, 10000),
            'token' => Str::random(50),
        ];
    }
}
