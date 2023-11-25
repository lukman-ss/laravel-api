<?php

use Illuminate\Http\Request;
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
Route::post('auth/login', [App\Http\Controllers\API\Auth\LoginController::class, '__invoke']);

Route::middleware('auth:sanctum')->group(function() {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [App\Http\Controllers\API\Auth\RegisterController::class, '__invoke']);
        Route::post('/logout', [App\Http\Controllers\API\Auth\LogoutController::class, '__invoke']);
    });

    Route::prefix('course')->group(function () {
        Route::get('/list', [App\Http\Controllers\API\Course\ListCourseController::class, '__invoke']);
        // Route::post('/logout', [App\Http\Controllers\API\Auth\LogoutController::class, '__invoke']);
    });
});
