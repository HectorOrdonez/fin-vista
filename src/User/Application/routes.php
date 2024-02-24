<?php

use FinVista\Company\Application\Controller\CompanyController;
use FinVista\User\Application\Controller\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class . '@index');

Route::post('/companies', CompanyController::class . '@store');
Route::get('/companies', CompanyController::class . '@index');
