<?php

namespace FinVista\User\Application\Livewire;

use FinVista\User\Application\UseCase\CreateUser;
use FinVista\User\Domain\Exception\UserAlreadyExists;
use Livewire\Component;

class RegisterUser extends Component
{
    public string $email;

    protected array $rules = ['email' => 'required|email'];

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(CreateUser $createUser): void
    {
        try {
            ($createUser)($this->email);
        } catch (UserAlreadyExists) {
            $this->addError(
                'email',
                sprintf('User with email %s already exists.', $this->email),
            );

            return;
        }

        session()->flash('message', 'Registered successfully. You will receive a login link in your email shortly.');

        $this->redirect(route('landing-page'));
    }

    public function render()
    {
        return view('user::livewire.register-user');
    }
}
