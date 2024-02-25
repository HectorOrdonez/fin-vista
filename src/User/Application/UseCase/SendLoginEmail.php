<?php

namespace FinVista\User\Application\UseCase;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\LoginTokenRepositoryInterface;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\UserRepositoryInterface;

class SendLoginEmail
{
    public function __construct(
        private readonly MailerInterface               $mailer,
        private readonly UserRepositoryInterface       $userRepository,
        private readonly LoginTokenRepositoryInterface $loginTokenRepository,
    )
    {

    }

    public function __invoke(string $email): void
    {
        // Should this logic go to the domain layer or application?
        $user  = $this->userRepository->findByEmail($email);

        $token = LoginToken::generateFor($user);

        $this->loginTokenRepository->create($token);

        $this->mailer->sendToken($user, $token);
    }
}
