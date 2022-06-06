<?php

use App\Http\Controllers\Painel\ACL\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('painel')->middleware(['auth', 'can:admin-painel'])->group(function () {
    Route::get('/', [App\Http\Controllers\Painel\HomeController::class, 'index'])->name('painel');

    Route::get('/scroll', [App\Http\Controllers\Painel\ACL\RolesController::class, 'scroll'])->name('scroll');
});

Route::prefix('v2')->middleware('auth:web')->group(function () {
    Route::get('roles', [App\Http\Controllers\Painel\ACL\RolesController::class, 'roles'])->name('roles.all');
});
