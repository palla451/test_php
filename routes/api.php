<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OpenBreweryController;




Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::get('validate-token', [AuthController::class, 'validateToken']);
    Route::get('breweries', [OpenBreweryController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});
