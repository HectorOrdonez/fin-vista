<?php

namespace FinVista\User\Infrastructure;

use FinVista\User\Domain\Exception\UserAlreadyExists;
use FinVista\User\Domain\Exception\UserNotFound;
use FinVista\User\Domain\User;
use FinVista\User\Domain\UserRepositoryInterface;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

class DbUserRepository implements UserRepositoryInterface
{
    /** @throws UserAlreadyExists */
    public function create(User $user): int
    {
        try {
            DB::insert('INSERT INTO users(email) VALUES(?)', [
                $user->email,
            ]);
        } catch (UniqueConstraintViolationException)
        {
            UserAlreadyExists::for($user);
        }

        $user->id = DB::getPdo()->lastInsertId();

        return $user->id;
    }

    /** @throws UserNotFound */
    public function findByEmail(string $email): User
    {
        $result = DB::selectOne('SELECT id, email FROM users WHERE email = ?', [$email]);

        if($result === null)
        {
            UserNotFound::for($email);
        }

        $user = new User();
        $user->id = $result->id;
        $user->email = $result->email;

        return $user;
    }
}
