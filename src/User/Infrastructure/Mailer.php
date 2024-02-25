<?php

namespace FinVista\User\Infrastructure;

use FinVista\User\Domain\LoginToken;
use FinVista\User\Domain\MailerInterface;
use FinVista\User\Domain\User;
use Illuminate\Support\Facades\Mail;

class Mailer implements MailerInterface
{
    public function sendToken(User $user, LoginToken $token): void
    {
        $auth  = route('sessions.auth');
        $email = <<<HTML
You requested a login token. Here it is:
<a href="$auth?token=$token->token">Link</a>
HTML;

        Mail::raw($email, function ($message) use ($user) {
            $message->to($user->email)->subject('Login to Fin-Vista');
        });
    }
}
