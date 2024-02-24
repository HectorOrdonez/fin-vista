<?php

use FinVista\Company\Domain\Model\Company;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/companies', function() {
    return Company::create([
        'name' => request('name'),
        'description' => request('description'),
        'address' => request('address'),
    ]);
});
