<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SharedListaController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', RegisterController::class)->name('register');

    Route::prefix('tokens')->name('tokens.')->group(function () {
        Route::post('/', [TokenController::class, 'store'])->name('store');

        Route::middleware('auth:sanctum')->group(function () {
            Route::delete('current', [TokenController::class, 'destroy'])->name('destroy');
            Route::delete('/', [TokenController::class, 'destroyAll'])->name('destroyAll');
        });
    });
});

Route::middleware('auth:sanctum')->prefix('lista')->name('lista.')->group(function () {
    Route::post('/', [ListaController::class, 'store'])->name('store');
    Route::get('/', [ListaController::class, 'index'])->name('index');

    Route::prefix('item')->name('item.')->group(function () {
        Route::post('/', [ItemController::class, 'store'])->name('store');
    });

    Route::prefix('shared')->name('shared.')->group(function () {
        Route::post('/', [SharedListaController::class, 'store'])->name('store');
        Route::get('/{code}', [SharedListaController::class, 'show'])->name('show');

        Route::prefix('guest')->name('guest.')->group(function () {
            Route::put('/{code}', [GuestController::class, 'update']);
        });
    });
});
