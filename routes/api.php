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

Route::post('auth/register', [App\Http\Controllers\API\Auth\RegisterController::class, '__invoke']);
Route::middleware('auth:sanctum')->group(function() {

    Route::prefix('auth')->group(function () {
        Route::post('/logout', [App\Http\Controllers\API\Auth\LogoutController::class, '__invoke']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/list', [App\Http\Controllers\API\User\ListUserController::class, '__invoke']);
        Route::post('/assign', [App\Http\Controllers\API\User\AssignRoleUserController::class, '__invoke']);
    });

    Route::prefix('course')->group(function () {
        Route::get('/list', [App\Http\Controllers\API\Course\ListCourseController::class, '__invoke']);
        Route::post('/create', [App\Http\Controllers\API\Course\CreateCourseController::class, '__invoke']);
        Route::get('/detail/{id}', [App\Http\Controllers\API\Course\DetailCourseController::class, 'show']);
        Route::delete('/delete/{id}', [App\Http\Controllers\API\Course\DeleteCourseController::class, '__invoke']);
        Route::post('/update/{id}', [App\Http\Controllers\API\Course\UpdateCourseController::class, '__invoke']);
        // Route::post('/logout', [App\Http\Controllers\API\Auth\LogoutController::class, '__invoke']);
    });
});
