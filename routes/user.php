<?php


use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\RegisterController;
//use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\user\ResetPasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'create'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('store');
        Route::get('/login',[LoginController::class,'create'])->name('login');
        Route::post('/login',[LoginController::class,'store']);
        Route::get('/forget-password', [ResetPasswordController::class, 'index'])->name('forget-password');
        Route::post('/get-otp-code', [ResetPasswordController::class, 'getOtp'])->name('get-otp');
        Route::get('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');
        Route::post('/update-password', [ResetPasswordController::class, 'updatePassword'])->name('update-password');
    });

Route::post('/logout', [LoginController::class, 'destroy'])->
middleware('auth')->name('logout');


