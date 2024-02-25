<?php

namespace FinVista\User\Domain\Exception;

use Exception;

class UserNotFound extends Exception
{
    private const ID_NOT_FOUND = 'User with id %d was not found';
    private const EMAIL_NOT_FOUND = 'User with email %s was not found';

    /** @throws self */
    public static function forId(int $id): self
    {
        throw new self(sprintf(self::ID_NOT_FOUND, $id));
    }

    /** @throws self */
    public static function forEmail(string $email): self
    {
        throw new self(sprintf(self::EMAIL_NOT_FOUND, $email));
    }
}
