<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SharedListaController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

// Auth
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        // Register
        Route::post('register', RegisterController::class)->name('register');

        // Login
        Route::prefix('tokens')
            ->name('tokens.')
            ->controller(TokenController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');

                // Log Out
                Route::middleware('auth:sanctum')->group(function () {
                    // Log Out From Current Device
                    Route::delete('current', 'destroy')->name('destroy');
                    // Log Out All
                    Route::delete('/', 'destroyAll')->name('destroyAll');
                });
            });
    });

// Lista
Route::middleware('auth:sanctum')
    ->prefix('lista')
    ->name('lista.')
    ->group(function () {
        Route::controller(ListaController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::get('/', 'index')->name('index');
                Route::get('{id}', 'show')->name('show');
            });

        // Lista:Item
        Route::prefix('item')
            ->name('item.')
            ->controller(ItemController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::get('{id}', 'show')->name('show');
            });

        // Lista:Shared
        Route::prefix('shared')
            ->name('shared.')
            ->controller(SharedListaController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::get('/', 'index')->name('index');
                Route::get('{code}', 'show')->name('show');

                // Lista:Shared:Guest
                Route::prefix('guest')
                    ->controller(GuestController::class)
                    ->group(function () {
                        Route::put('{code}', 'update')->name('guest.update');
                    });
            });

        // Wild card that was causing trouble to this guy here! put it in the last position due misunderstood with what is an id or not
        Route::get('{id}', [ListaController::class, 'show'])->whereNumber('id')->name('show');
    });
