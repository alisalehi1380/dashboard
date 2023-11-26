<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('login', "auth.login")->name('login');
    Route::post('login', [LoginController::class, 'login'])->middleware('throttle:1,1')->name('login.post');

    Route::view('register', "auth.register")->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');

    Route::view('otp1', "auth.otp.otp1")->name('otp1');
    Route::post('otp1', [LoginController::class, 'otp1'])->name('otp1.post');

    Route::view('otp2', "auth.otp.otp2")->name('otp2');
    Route::post('otp2', [LoginController::class, 'otp2'])->name('otp2.post');

});
Route::any('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
