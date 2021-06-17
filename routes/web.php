<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route Admin
Route::prefix('admin')->group(function(){
    Route::group(['middleware' => 'auth'], function(){
        Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard.index');

        Route::resource('permission', PermissionController::class, ['as' => 'admin'])
        ->except('show', 'create', 'edit', 'update', 'delete');

        Route::resource('role', RoleController::class, ['as' => 'admin'])
        ->except('show');

        Route::resource('user', UserController::class, ['as' => 'admin'])
        ->except('show');
    });
});
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
