<?php

use App\Helpers\NavigationHelper;
use App\Http\Controllers\APIAuth\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\Playback\Player\NavigationController;
use App\Http\Controllers\Playback\PlaybackController;
use App\Http\Controllers\Playback\Player\StateController;
use App\Http\Controllers\Playback\QueueController;
use App\Http\Controllers\SearchController;
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
        Route::controller(SearchController::class)->group(function () {
            Route::get('/tracks/search/{id?}', 'renderSearch')
                ->name('tracks.search');

            Route::get('/tracks/list/{id?}', 'getTracks')
                ->name('tracks.search.list');
        });

        Route::middleware([APICustomerAuthMiddleware::class])->group(function () {
            Route::controller(CustomerController::class)->group(function () {
                Route::get('/customers/refresh/{id}', 'refresh')
                    ->name('customers.refresh');
            });

            Route::controller(PlaybackController::class)->group(function () {
                Route::get('/customers/details/{id}/playback/get', 'renderPlayer')
                    ->name('customers.details.playback');
            });

            Route::controller(QueueController::class)->group(function () {
                Route::get('/queue/{id}', 'renderQueue')
                    ->name('tracks.queue');

                Route::post('/queue/{id}/add/', 'addToQueue')
                    ->name('tracks.queue.add');
            });

            Route::controller(StateController::class)->group(function () {
                Route::get('/customers/details/{id}/playback/switch/{action}/{state}', 'switchState')
                    ->name('customers.details.playback.state');
            });

            Route::controller(NavigationController::class)->group(function () {
                Route::get('/customers/details/{id}/playback/track/{action}', 'changeTrack')
                    ->name('customers.details.playback.track');
            });
        });
    });

    Route::middleware([Navigate::class])->group(function () {
        Route::controller(CustomerController::class)->group(function () {

            Route::get('/', 'list')
                ->name('dashboard');

            Route::middleware([APICustomerAuthMiddleware::class])->group(function () {
                Route::get('/customers/details/{id}', 'details')
                    ->name('customers.details');
            });

            Route::get('/customers/delete/{id}', 'delete')
                ->withoutMiddleware([Navigate::class])
                ->name('customers.delete');
        });

        Route::controller(UserController::class)->group(function () {
            Route::middleware(['password.confirm:,30'])->group(function () {
                Route::get('/users/edit/{id}', 'edit')
                    ->name('users.edit');

                Route::get('/users/edit/pass/{id}', 'editPass')
                    ->name('users.pass.edit');
            });

            Route::put('/users/edit/{id}', 'update')
                ->name('users.update');

            Route::get('/users/details/{id}', 'details')
                ->name('users.details');
        });

        Route::middleware([IsAdmin::class])->group(function () {

            Route::controller(LogController::class)->group(function () {
                Route::get('/logs/{userID?}', 'list')
                    ->name('logs.list');
            });

            Route::controller(UserController::class)->group(function () {
                Route::get('/users', 'list')
                    ->name('users.list');

                Route::get('/users/delete/{id}', 'delete')
                    ->withoutMiddleware([Navigate::class])
                    ->name('users.delete');
            });
        });
    });
});