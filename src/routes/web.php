<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SettlementController;
use Illuminate\Support\Facades\Route;

// *** Authentification (Public) ***

Route::get('/register/{token?}', function () {
    return view('auth.register');
})->name('register');

Route::post('/register/{token?}', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/home', function(){
    return view('home');
})->name('home');


// *** Routes Protégées (Utilisateurs Connectés) ***
Route::middleware('auth')->group(function(){
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- GROUPE ADMIN (Seulement pour les Admins) ---
    Route::middleware('can:only_admin')->group(function() {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/users/{user}/ban', [AdminController::class, 'ban'])->name('admin.users.ban');
        Route::post('/admin/users/{user}/unban', [AdminController::class, 'unban'])->name('admin.users.unban');
        
        // Route de test dashboard
        Route::get('/dashboard', function(){
            return view('admin.dashboard');
        });
    });

    // --- GROUPE ACTIF (Interdit aux utilisateurs bannis) ---
    Route::middleware('can:is_active')->group(function() {
        
        // __colocation__
        Route::get('/colocation/create', function(){
            return view('colocation.create');
        })->name('colocation.create');
        
        Route::post('colocation', [ColocationController::class, 'store'])->name('colocation.store');
        Route::get('/colocation', [ColocationController::class, 'show'])->name('colocation.show');
        
        // __Invitation__
        Route::get('/respond', function(){
            return view('invitations.respond');
        });
        
        Route::get('/send', function(){
            return view('invitations.send');
        })->name('invitations.send');
        
        Route::post('/invitation', [InvitationController::class, 'store'])->name('invitations.store');
        
        Route::get('/email', function(){
            return view('emails.invite');
        });
        
        Route::get('/invitations/reject/{token}', [InvitationController::class, 'reject'])->name('invitations.reject');
        
        // __Category__
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

        // __expenses__
        Route::get('/colocation/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/colocation/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

        // __settlement__ 
        Route::post('/settlements', [SettlementController::class, 'store'])->name('settlements.store');
    });
});