<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::controller(ContactController::class)->name('contact.')->group(function () {
    Route::get('contact', 'create')->name('create');
    Route::post('contact', 'store');
});
