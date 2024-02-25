<?php

namespace FinVista\User\Domain\Exception;

use Exception;
use FinVista\User\Domain\User;

class UserAlreadyExists extends Exception
{
    private const MESSAGE = 'User with email %s already exists';

    /** @throws self */
    public static function for(User $user): self
    {
        throw new self(sprintf(self::MESSAGE, $user->email));
    }
}
