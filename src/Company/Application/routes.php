<?php

use FinVista\Company\Application\Controller\CompanyController;
use Illuminate\Support\Facades\Route;

Route::post('/companies', CompanyController::class . '@store');
Route::get('/companies', CompanyController::class . '@index');
