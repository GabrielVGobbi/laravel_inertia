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

Route::name('api.')->prefix('panel/')->middleware('auth:web')->group(function () {
    Route::name('table.')->prefix('tables/')->group(function () {
        Route::get('users', [App\Http\Controllers\Api\TablesApiController::class, 'users'])->name('users');
        Route::get('permissions', [App\Http\Controllers\Api\TablesApiController::class, 'permissions'])->name('permissions');
    });
});
