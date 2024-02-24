<?php

use FinVista\Company\Application\UseCase\CreateCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/companies', function (Request $request) {
    return response(app(CreateCompany::class)($request), 201);
});
