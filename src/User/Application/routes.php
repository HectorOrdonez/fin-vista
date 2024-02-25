<?php

namespace FinVista\User\Application\Route;

use FinVista\User\Application\Controller\LandingPageController;
use FinVista\User\Application\Controller\SessionController;
use FinVista\User\Application\Controller\UserController;
use Illuminate\Support\Facades\Route as RouteFacade;

RouteFacade::get('/', LandingPageController::class . '@index')->name('landing-page');

RouteFacade::post('users', UserController::class . '@store')->name('users.store');
RouteFacade::get('users/create', UserController::class . '@create')->name('users.create');

RouteFacade::post('sessions', SessionController::class . '@store')->name('sessions.store');
RouteFacade::get('sessions/create', SessionController::class . '@create')->name('sessions.create');
RouteFacade::get('sessions/auth{token}', SessionController::class . '@auth')->name('sessions.auth');
