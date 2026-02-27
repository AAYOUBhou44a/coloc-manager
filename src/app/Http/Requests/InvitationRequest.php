<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidatin(){
        $this->merge([
            'owner_id' => Auth::id(),
            'user_id' => null,
            'token' => Str::random(40),
            'colocation_id' => auth()->user()->colocation->id
        ]);
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'owner_id' => 'required|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'token' => 'required|string|unique:invitations,token',
            'colocation_id' => 'required|exists:colocations,id'
        ];
    }

    public function messages(): array
    {
        return 
        [
            // Email
            'email.required' => 'L\'adresse email est obligatoire pour envoyer une invitation.',
            'email.email'    => 'L\'adresse email entrée n\'est pas valide.',
            
            // Token
            'token.required' => 'Un jeton de sécurité est nécessaire.',
            'token.unique'   => 'Ce jeton a déjà été généré, merci de réessayer.',
            
            // Colocation
            'colocation_id.required' => 'Vous devez appartenir à une colocation pour inviter quelqu\'un.',
            'colocation_id.exists'   => 'La colocation spécifiée est introuvable.',
            
            // Propriétaire (Owner)
            'owner_id.required' => 'L\'identifiant de l\'invitant est requis.',
            'owner_id.exists'   => 'L\'utilisateur qui invite n\'existe pas dans notre base.',
        ];
    }
}
