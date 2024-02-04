<?php

use App\Http\Controllers\News\User\NewsUserController;
use App\Http\Controllers\User\Auth\RegisterUserController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [RegisterUserController::class, 'register']);
Route::post('/login', [RegisterUserController::class, 'login']);
Route::apiResource('news',NewsUserController::class)->only('index');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('user',UserController::class)->only('index');
    Route::apiResource('news',NewsUserController::class);

    Route::post('/logout', [RegisterUserController::class, 'logout']);
});


