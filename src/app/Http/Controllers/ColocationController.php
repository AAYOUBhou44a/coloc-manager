<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function store(ColocationRequest $request){
        $data = $request->validated();
        $colocation = Colocation::create($data);
        $colocation->users()->attach(Auth::id(),[
        'role' => 'owner',
        'balance' => 0.00,
        'left_at' => null
        ]);
        return $colocation ? redirect()->route('colocation.show', Auth::id()) : back();
    }

    public function show() {
    $user = Auth::user();
    
    // On récupère la colocation active avec toutes les relations nécessaires
    $colocation = $user->colocation()
        ->wherePivot('left_at', null)
        ->with(['users', 'categories', 'expenses.category', 'expenses.user']) 
        ->first();

    if (!$colocation) {
        return redirect()->route('home')->with('error', 'Vous n\'avez pas de colocation, essayez d\'en créer une.');
    }

    return view('colocation.show', compact('colocation'));
}
}
