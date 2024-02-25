<?php

namespace FinVista\User\Application\UseCase;

use FinVista\User\Domain\LoginTokenRepositoryInterface;
use FinVista\User\Domain\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly LoginTokenRepositoryInterface $loginTokenRepository,
    )
    {

    }

    public function __invoke(string $token): void
    {
        $token = $this->loginTokenRepository->findByToken($token);
        $user = $this->userRepository->findById($token->userId);

        Auth::login($user);

        $this->loginTokenRepository->delete($token);
    }
}
