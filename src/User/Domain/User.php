<?php

namespace FinVista\User\Domain;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    public ?int $id = null;
    public string $email = '';

    public static function create(string $email): self
    {
        $user        = new User();
        $user->email = $email;

        return $user;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier(): string
    {
        return $this->getAuthIdentifierName();
    }

    public function getAuthPassword(): void
    {
        throw new \Exception('Not implemented');
    }

    public function getRememberToken()
    {
        throw new \Exception('Not implemented');
    }

    public function setRememberToken($value)
    {
        throw new \Exception('Not implemented');
    }

    public function getRememberTokenName()
    {
        throw new \Exception('Not implemented');
    }
}
