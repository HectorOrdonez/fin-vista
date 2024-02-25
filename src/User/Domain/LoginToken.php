<?php

namespace FinVista\User\Domain;

use Illuminate\Support\Str;

class LoginToken
{
    public ?int $id;
    public int $userId;
    public string $token;

    public static function generateFor(User $user): self
    {
        $token = new self();
        $token->userId = $user->id;
        $token->token = Str::random(50);

        return $token;
    }
}
