<?php

namespace FinVista\User\Domain\Exception;

use Exception;

class LoginTokenNotFound extends Exception
{
    private const TOKEN_NOT_FOUND = 'Token %s was not found';

    /** @throws self */
    public static function for(string $token): void
    {
        throw new self(sprintf(self::TOKEN_NOT_FOUND, $token));
    }
}
