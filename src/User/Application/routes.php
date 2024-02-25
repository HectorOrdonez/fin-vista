<?php

namespace FinVista\User\Application\Route;

use FinVista\User\Application\Controller\LandingPageController;
use FinVista\User\Application\Controller\SessionController;
use Illuminate\Support\Facades\Route as RouteFacade;

RouteFacade::get('/', LandingPageController::class . '@index');

RouteFacade::get('login', SessionController::class . '@create')->name('login');
RouteFacade::post('login', SessionController::class . '@store');
RouteFacade::get('auth/token{token}', SessionController::class . '@authenticate')->name('authenticate');
