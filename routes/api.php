<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function ($router) {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/register', [AuthController::class, 'register']);
    });
});
