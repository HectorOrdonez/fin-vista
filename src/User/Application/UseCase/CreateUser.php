<?php

namespace FinVista\User\Application\UseCase;

use FinVista\User\Domain\User;
use FinVista\User\Domain\UserRepositoryInterface;

/**
 * This use case calls another use case
 * Such a topic might be controversial. I found this answer to be both pragmatical and logical:
 * @link https://stackoverflow.com/questions/43803666/clean-architecture-combining-interactors
 */
class CreateUser
{
    public function __construct(
        private readonly SendLoginEmail                $sendLoginEmail,
        private readonly UserRepositoryInterface       $userRepository,
    )
    {

    }

    public function __invoke(string $email): void
    {
        $user = User::create($email);
        $this->userRepository->create($user);

        ($this->sendLoginEmail)($email);
    }
}
