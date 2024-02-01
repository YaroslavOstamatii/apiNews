<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('user',UserController::class)->only('index');
    Route::apiResource('news',NewsController::class);

    Route::post('/logout', [RegisterUserController::class, 'logout']);
});


