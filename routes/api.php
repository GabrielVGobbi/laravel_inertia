<?php

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

Route::post('auth', [App\Http\Controllers\Api\Auth\AuthApiController::class, 'auth'])->name('auth.api');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('users', [App\Http\Controllers\Api\UserApiController::class, 'index'])->name('users.all');
});
