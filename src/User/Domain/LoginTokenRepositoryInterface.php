<?php

namespace FinVista\User\Domain;

interface LoginTokenRepositoryInterface
{
    public function create(LoginToken $token);
}
