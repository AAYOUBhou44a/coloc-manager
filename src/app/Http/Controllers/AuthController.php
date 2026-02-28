<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Quand tu utilises $request->validated() dans ton contrôleur, Laravel ne te renvoie que les champs qui sont définis dans ton tableau rules().
    //=== : comparaison   , = : pour donner une valeur à un variable
    public function register(RegisterRequest $request, $token = null){
        $data = $request->validated();

        $token = $token ?? $request->input('token');
        if(User::count()===0){
            $data['global_role'] = 'admin';
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        
        auth()->login($user);

        $invitation = Invitation::where('token', $token)->first();

        if($token && !$invitation){
            return redirect()->route('home')->with('error', 'invitation invalide');
        }

        if($token && $invitation){
            $invitation->colocation->users()->attach($user->id, [
                'role' => 'member',
                'balance' => 0.00,
                'left_at' => null
            ]);

            return redirect()->route('colocation.show')->with('success', 'Vous etez désormis un membre de la colocation');
        }

        return redirect()->route('home');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'email ou password incorrect'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
