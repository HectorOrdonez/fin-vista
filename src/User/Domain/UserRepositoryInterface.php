<?php

namespace FinVista\User\Domain;

use FinVista\User\Domain\Exception\UserAlreadyExists;
use FinVista\User\Domain\Exception\UserNotFound;

interface UserRepositoryInterface
{
    /** @throws UserAlreadyExists */
    public function create(User $user): int;

    /** @throws UserNotFound */
    public function findById(int $id): User;

    /** @throws UserNotFound */
    public function findByEmail(string $email): User;
}
