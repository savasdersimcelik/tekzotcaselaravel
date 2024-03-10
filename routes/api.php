<?php

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

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('test', [\App\Http\Controllers\Controller::class, 'test']);


    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('refresh/token', [\App\Http\Controllers\AuthController::class, 'refreshToken']);

    Route::prefix('subscriber')->group(function () {
        Route::post('create', [\App\Http\Controllers\SubscriptionController::class, 'create']);
        Route::get('status', [\App\Http\Controllers\SubscriptionController::class, 'status']);
        Route::post('cancel', [\App\Http\Controllers\SubscriptionController::class, 'cancel']);
    });

    Route::prefix('package')->group(function () {
        Route::get('list', [\App\Http\Controllers\PackageController::class, 'index']);
    });

    Route::prefix('card')->group(function () {
        Route::get('list', [\App\Http\Controllers\CardController::class, 'index']);
    });
});
