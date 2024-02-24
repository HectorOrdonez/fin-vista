<?php

use FinVista\Company\Application\UseCase\CreateCompany;
use FinVista\Company\Application\UseCase\GetCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/companies', function (Request $request) {
    return app(CreateCompany::class)($request);
});

Route::get('/companies', function (Request $request) {
    return app(GetCompanies::class)($request);
});
