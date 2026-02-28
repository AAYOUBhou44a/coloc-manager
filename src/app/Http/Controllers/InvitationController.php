<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Mail\InviteMemberMail;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function store(InvitationRequest $request){
        $data = $request->validated();
        $invitation = Invitation::create($data);
        if($invitation){
            Mail::to($invitation->email)->send(new InviteMemberMail($invitation));
            return  redirect()->route('colocation.show')->with('success', 'l\'email est envoyé avec succès');
        }

        return back()->with('error', 'un problème est survenu lors de la création de l\'invitation');
    }

    public function reject($token){
        $invitation = Invitation::where('token', $token)->first();
        if($invitation){
            $invitation->update(['status' => 'refused']);
            return redirect()->route('home')->with('success', 'L\'invitation a bien été refusée');
        }

        return redirect()->route('home')->with('error', 'Invitation invalide');
    }
    
}
