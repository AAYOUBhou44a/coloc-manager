<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitation;
use App\Models\Colocation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Récupération des statistiques réelles
        $stats = [
            'total_users' => User::count(),
            'total_colocations' => Colocation::count(),
            'total_banned' => User::where('banned_at', '!=', null)->count(),
            'new_users_24h' => User::where('created_at', '>=', now()->subDay())->count(),
        ];

        // 2. Récupération de tous les utilisateurs (triés par les plus récents)
        $users = User::latest()->get();

        return view('admin.dashboard', compact('stats', 'users'));
    }

    public function ban(User $user)
{
    if ($user->global_role === 'admin') {
        return back()->with('error', 'Impossible de bannir un administrateur.');
    }

    // On remplit la date au lieu d'un booléen inexistant
    $user->update([
        'banned_at' => now() 
    ]);

    return back()->with('success', "L'utilisateur {$user->name} a été banni.");
}

public function unban(User $user)
{
    // On remet à null pour débannir
    $user->update([
        'banned_at' => null
    ]);

    return back()->with('success', "Le compte de {$user->name} a été réactivé.");
}
}