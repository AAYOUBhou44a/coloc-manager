<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// *** Authentification ***
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');




