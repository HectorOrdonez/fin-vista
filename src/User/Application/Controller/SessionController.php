<?php

namespace FinVista\User\Application\Controller;

use App\Http\Controllers\Controller;
use FinVista\User\Application\UseCase\SendLoginEmail;
use FinVista\User\Domain\Exception\UserNotFound;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('user::login');
    }

    public function store(Request $request,  SendLoginEmail $sendLoginEmail)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $sendLoginEmail($request->get('email'));
        } catch (UserNotFound $userNotFound)
        {
            dd('TODO: redirecting');
            // redirect to login page with error message
        }

        return redirect(route('login'));
    }
}
