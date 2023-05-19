<?php

use App\Helpers\NavigationHelper;
use App\Http\Controllers\APIAuth\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\APICustomerAuthMiddleware;
use App\Http\Middleware\APIUserAuthMiddleware;
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


Route::controller(CustomerAuthController::class)->group(function () {
    Route::get('/authorize', 'getToken')
            ->name('customer.auth');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/auth', 'create')
            ->name('customers.create');
});


Route::middleware([Authenticate::class])->group(function () {

    Route::controller(NavigationHelper::class)->group(function () {
        Route::get('/back', 'back')
            ->name('back');
    });

    Route::middleware([APIUserAuthMiddleware::class])->group(function () {
        // Requests to Spotify API
        Route::middleware([APICustomerAuthMiddleware::class])->group(function () {
            Route::controller(CustomerController::class)->group(function () {
                Route::get('/customers/refresh/{id}', 'refresh')
                    ->name('customers.refresh');
            });
        });
    });

    Route::middleware([Navigate::class])->group(function () {
        Route::controller(CustomerController::class)->group(function () {

            Route::get('/', 'list')
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
});