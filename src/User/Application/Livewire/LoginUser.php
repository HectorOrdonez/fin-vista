<?php

namespace FinVista\User\Application\Livewire;

use FinVista\User\Application\UseCase\SendLoginEmail;
use FinVista\User\Domain\Exception\UserNotFound;
use Livewire\Component;

class LoginUser extends Component
{
    public string $email;

    protected array $rules = ['email' => 'required|email'];

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(SendLoginEmail $sendLoginEmail): void
    {
        try {
            ($sendLoginEmail)($this->email);
        } catch (UserNotFound) {
            $this->addError(
                'email',
                sprintf('User with email %s does not seem to exist. Did you forget to register?', $this->email),
            );

            return;
        }

        session()->flash('message', 'You will receive a login link in your email shortly.');

        $this->redirect(route('landing-page'));
    }

    public function render()
    {
        return view('user::livewire.login-user');
    }
}
