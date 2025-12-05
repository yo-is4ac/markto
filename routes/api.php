<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ListaController;
use App\Http\Controllers\ItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('list')->name('list.')->group(function() {
    Route::post('/', [ListaController::class, 'store'])->name('store');

    Route::prefix('item')->name('item.')->group(function(){
        Route::post('/', [ItemController::class, 'store'])->name('create');
    });
});
