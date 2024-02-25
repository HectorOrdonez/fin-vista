<?php

namespace FinVista\User\Application\Controller;

use App\Http\Controllers\Controller;
use FinVista\User\Application\UseCase\CreateUser;
use FinVista\User\Domain\Exception\UserAlreadyExists;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('user::users.create');
    }

    public function store(Request $request, CreateUser $createUser)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $createUser($request->get('email'));
        } catch(UserAlreadyExists)
        {
            // @todo Add flash message
            return redirect(route('landing-page'));
        }

        return redirect(route('landing-page'));
    }
}
