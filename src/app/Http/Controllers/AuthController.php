<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Quand tu utilises $request->validated() dans ton contrôleur, Laravel ne te renvoie que les champs qui sont définis dans ton tableau rules().
    //=== : comparaison   , = : pour donner une valeur à un variable
    public function register(RegisterRequest $request){
        $data = $request->validated();

        if(User::count()===0){
            $data['global_role'] = 'admin'; 
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect()->route('login');
    }

    
}
