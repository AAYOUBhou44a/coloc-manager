<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Gate pour restreindre l'accès aux admins uniquement
    Gate::define('only_admin', function(User $user) {
        return $user->global_role === 'admin';
    });

    // Gate pour vérifier si l'utilisateur n'est PAS banni
    // (Utile pour autoriser l'accès aux fonctions de l'app)
    Gate::define('is_active', function(User $user) {
        return is_null($user->banned_at);
    });
}
}
