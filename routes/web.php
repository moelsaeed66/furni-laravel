<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::view('/about', 'Front.about.about-us')->name('about');
Route::get('/services', [ServiceController::class,'index'])->name('services');


require __DIR__.'/payment.php';
require __DIR__.'/cart.php';
require __DIR__.'/user.php';
require __DIR__.'/contact.php';
require __DIR__.'/blog.php';
require __DIR__.'/product.php';

