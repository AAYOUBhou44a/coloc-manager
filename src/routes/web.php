<?php

use Illuminate\Support\Facades\Route;

// *** Authentification ***
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');


