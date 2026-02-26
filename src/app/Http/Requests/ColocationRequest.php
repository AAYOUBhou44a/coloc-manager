<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ColocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return !Auth::user()->colocation()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation(){
        $this->merge([
            'status' => 'active',
            'owner_id' => Auth::id()
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|between:3,255',
            'status' => 'required|string|in:active,canceled',
            'owner_id' => 'required|exists:users,id|unique:colocations,owner_id'
        ];
    }

    public function messages(): array
    {
        return 
        [
            // Nom de la colocation
            'name.required' => 'Le nom de la colocation est obligatoire.',
            'name.string'   => 'Le nom doit être une chaîne de caractères.',
            'name.between'  => 'Le nom doit comporter entre 3 et 255 caractères.',

            // Statut
            'status.required' => 'Le statut est obligatoire.',
            'status.in'       => 'Le statut sélectionné n’est pas valide.',

            // Propriétaire (Owner)
            'owner_id.required' => 'L’identifiant du propriétaire est requis.',
            'owner_id.exists'   => 'L’utilisateur propriétaire n’existe pas.',
            'owner_id.unique'   => 'Vous êtes déjà propriétaire d’une colocation. Vous ne pouvez pas en créer une deuxième.',
        ];
    }
}
