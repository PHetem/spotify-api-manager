<?php

use App\Helpers\NavigationHelper;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\Navigate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware([Authenticate::class, Navigate::class])->group(function () {

    Route::controller(NavigationHelper::class)->group(function () {
        Route::get('/back', 'back')
            ->withoutMiddleware([Navigate::class])
            ->name('back');
    });

    Route::controller(CustomerController::class)->group(function () {

        Route::get('/', 'dashboard')
            ->name('dashboard');

        Route::get('/customers/details/{id}', 'details')
            ->name('customers.details');

        Route::get('/customers/delete/{id}', 'delete')
            ->withoutMiddleware([Navigate::class])
            ->name('customers.delete');
    });

    Route::middleware([IsAdmin::class])->group(function () {

        Route::controller(LogController::class)->group(function () {
            Route::get('/logs/{userID?}', 'list')
                ->name('logs.list');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'list')
                ->name('users.list');

            Route::get('/users/details/{id}', 'details')
                ->name('users.details');

            Route::get('/users/delete/{id}', 'delete')
                ->withoutMiddleware([Navigate::class])
                ->name('users.delete');
        });
    });
});