<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('register/activation/{token}', [RegisterController::class, 'signupActive']);

    Route::post('login', [LoginController::class, 'login']);

    // Private Route
    Route::middleware('auth:api')->group(function(){

        Route::get('users', [LoginController::class, 'users']);

    });
});
