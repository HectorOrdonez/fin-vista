<?php

namespace FinVista\User\Domain;

interface MailerInterface
{
    public function sendToken(User $user, LoginToken $token);
}
