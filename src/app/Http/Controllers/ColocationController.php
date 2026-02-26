<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
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
        return $colocation ? redirect()->route('home') : back();
    }

   
}
