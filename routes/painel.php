<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::prefix('painel')->middleware(['auth', 'can:admin-painel'])->group(function () {
    Route::get('/', [App\Http\Controllers\Painel\HomeController::class, 'index'])->name('painel');
});
