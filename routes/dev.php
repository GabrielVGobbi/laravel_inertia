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

Route::prefix('painel/dev')->middleware(['auth', 'role:dev'])->group(function () {
    Route::resource('users', App\Http\Controllers\Painel\ACL\UsersController::class);
    Route::resource('permissions', App\Http\Controllers\Painel\ACL\PermissonsController::class);
    Route::resource('roles', App\Http\Controllers\Painel\ACL\RolesController::class);
});
