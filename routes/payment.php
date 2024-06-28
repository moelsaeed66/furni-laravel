<?php
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;




Route::controller(PaymentController::class)
    ->prefix('payment')->name('payment.')->group(function () {

        Route::post('/checkout', 'pay')->middleware('auth')->name('checkout');
        Route::post('/callback', 'callback')->name('callback');
        Route::get('/success', 'success')->name('success');
    });
