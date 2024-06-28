<?php


use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('', [CartController::class, 'index'])->name('index');
    Route::post('add/{id}',[CartController::class,'store'] )->name('store');
    Route::post('update/{id}',[CartController::class,'update'] )->name('update');
    Route::delete('remove/{id}', [CartController::class,'destroy'])->name('destroy');
});
