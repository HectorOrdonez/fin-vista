<?php

use FinVista\Company\Application\Controller\CompanyController;
use Illuminate\Support\Facades\Route;

Route::post('/companies', CompanyController::class . '@store');
Route::get('/companies', CompanyController::class . '@index')->name('companies.index');
Route::get('/companies/create', CompanyController::class . '@create')->name('companies.create');
Route::get('/companies/store', CompanyController::class . '@store')->name('companies.store');
