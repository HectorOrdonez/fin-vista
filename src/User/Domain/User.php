<?php

namespace FinVista\User\Domain;

class User
{
    public ?int $id = null;
    public string $email = '';

    public static function create(string $email): self
    {
        $user        = new User();
        $user->email = $email;

        return $user;
    }
}
