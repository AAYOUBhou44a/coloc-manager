<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function store(InvitationRequest $request){
        $data = $request->validated();
        $invitation = Invitation::create($data);
        return $invitation ? redirect('colocation.show'): back()->with('error', 'un problème a survenu lors de la création de l\'invitation');
    }
}
