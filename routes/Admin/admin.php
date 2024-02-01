<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterAdminController;
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

Route::post('/register', [RegisterAdminController::class, 'register']);
Route::post('/login', [RegisterAdminController::class, 'login']);

Route::middleware(['auth:sanctum','admin'])->group(function () {
    Route::apiResource('admin',AdminController::class);
    Route::apiResource('news',NewsController::class);
    Route::apiResource('user',UserController::class);

    Route::post('/logout', [RegisterAdminController::class, 'logout']);
});





