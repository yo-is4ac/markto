<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TokenController;

Route::post('register', RegisterController::class)->name('register');
Route::post('token', [TokenController::class, 'store'])->name('token.store');

Route::prefix('list')->name('list.')->group(function() {
    Route::post('/', [ListaController::class, 'store'])->name('store');

    Route::prefix('item')->name('item.')->group(function(){
        Route::post('/', [ItemController::class, 'store'])->name('create');
    });
});
