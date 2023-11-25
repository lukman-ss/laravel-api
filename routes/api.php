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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\API\Auth\LoginController::class, '__invoke']);
    Route::post('/register', [App\Http\Controllers\API\Auth\RegisterController::class, '__invoke']);
    // Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\API\Auth\LogoutController::class, '__invoke']);
    // Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
});