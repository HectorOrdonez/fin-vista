<?php

namespace FinVista\User\Application\Controller;

use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('user::welcome');
    }
}
