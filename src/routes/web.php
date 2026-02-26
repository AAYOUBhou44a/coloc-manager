<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColocationController;
use Illuminate\Support\Facades\Route;

// *** Authentification ***
//__register__
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

//__login__
Route::get('/login', function(){
    return view('auth.login');
    })->name('login');
    
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

//__home__
Route::get('/home', function(){
    return view('home');
})->name('home');

//__logout__
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//__colocation__
Route::get('/colocation/create', function(){
    return view('colocation.create');
})->name('colocation.create');

Route::post('colocation', [ColocationController::class, 'store'])->name('colocation.store');

Route::get('/show', function(){
    return view('colocation.show');
});

// Route::get('/show/{id}', [ColocationController::class, 'show'])->name('colocation.show');