<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->name('products.')->group(function () {
    Route::get('','index')->name('index');
    Route::get('/{name}',  'show')->name('show');
});
