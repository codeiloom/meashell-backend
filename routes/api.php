<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Blog\BlogController;
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

    // Authentication Routes API
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('register/activation/{token}', [RegisterController::class, 'signupActive']);
    Route::post('login', [LoginController::class, 'login']);


    // Posts Routes API
    Route::get('posts', [BlogController::class, 'index']);
    Route::post('post', [BlogController::class, 'store']);
    Route::get('post/{id}', [BlogController::class, 'show']);
    Route::put('post/{id}', [BlogController::class, 'update']);
    Route::delete('post/{id}', [BlogController::class, 'destroy']);

    // Private Route
    Route::middleware('auth:api')->group(function () {

        Route::get('users', [LoginController::class, 'users']);
    });
});
