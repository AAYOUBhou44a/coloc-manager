<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function store(ColocationRequest $request){
        $data = $request->validated();
        $colocation = Colocation::create($data);
        return $colocation ? redirect()->route('home') : back();
    }
}
