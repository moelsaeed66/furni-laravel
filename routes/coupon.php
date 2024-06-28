<?php


use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;



Route::post('discount', [CouponController::class, 'checkCoupon'])
    ->middleware('auth')
    ->name('coupon.check');
