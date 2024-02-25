<?php

namespace FinVista\User\Domain;

interface LoginTokenRepositoryInterface
{
    public function create(LoginToken $token): int;

    public function findByToken(string $token): LoginToken;

    public function delete(LoginToken $token): void;
}
