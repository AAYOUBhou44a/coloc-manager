<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

// *** Authentification ***
//__register__

Route::get('/register/{token?}', function () {
    return view('auth.register');
})->name('register');

Route::post('/register/{token?}', [AuthController::class, 'register'])->name('register.store');

//__login__
Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

//__home__
Route::get('/home', function(){
    return view('home');
})->name('home');

// Route::get('/register/{token}', function(){
//     return view('register');
// });

// Route::post('/register/{token}', [InvitationController::class, 'register']);


Route::middleware('auth')->group(function(){
    //__logout__
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    //__colocation__
    Route::get('/colocation/create', function(){
        return view('colocation.create');
    })->name('colocation.create');
    
    Route::post('colocation', [ColocationController::class, 'store'])->name('colocation.store');
    
    Route::get('/colocation', [ColocationController::class, 'show'])->name('colocation.show');
    
    //__Invitation__
    Route::get('/respond', function(){
        return view('invitations.respond');
    });
    
    Route::get('/send', function(){
        return view('invitations.send');
    })->name('invitations.send');
    
    // Route::post('/send', [InvitationController::class, 'send'])->name('invitations.send');
    
    Route::post('/invitation', [InvitationController::class, 'store'])->name('invitations.store');
    
    Route::get('/email', function(){
        return view('emails.invite');
    });
    
    Route::get('/invitations/reject/{token}', [InvitationController::class, 'reject'])->name('invitations.reject');
    
    // __Category__
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
});
