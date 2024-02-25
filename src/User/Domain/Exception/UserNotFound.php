<?php

namespace FinVista\User\Domain\Exception;

use Exception;

class UserNotFound extends Exception
{
    private const MESSAGE = 'User with email %s was not found';

    /** @throws self */
    public static function for(string $email): self
    {
        throw new self(sprintf(self::MESSAGE, $email));
    }
}
