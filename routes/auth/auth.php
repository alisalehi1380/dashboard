<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('login', "auth.login")->name('login');
    Route::post('login', [LoginController::class, 'login'])->middleware('throttle:1,1')->name('login.post');

    Route::view('register', "auth.register")->name('register');
    Route::post('register', [LoginController::class, 'register'])->name('register.post');

});
Route::any('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
