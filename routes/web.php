<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OpenBreweryController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/breweries', function () {
    return view('breweries');
});
