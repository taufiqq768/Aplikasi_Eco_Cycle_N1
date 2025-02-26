<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\MobileApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/list-region', [MobileApiController::class, 'getRegion']);
});

Route::post('/login', [LoginController::class, 'auth']);
