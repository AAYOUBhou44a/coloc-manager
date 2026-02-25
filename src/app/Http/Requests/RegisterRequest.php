<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function prepareForValidation(){
        $this->merge([
            'global_role' => 'user',
            'reputation_score' => 0,
            'banned_at' => null
        ]);
    }

    public function rules(): array
    {
        // Dans Laravel, la règle(rule) float n'existe pas. La règle numeric  \ meme chose pour datetime (date)
        return [
        'name' => 'required|between:3,255|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3|string|confirmed',
        'reputation_score' => 'required|numeric',
        'global_role' => 'required|string',
        'banned_at' => 'nullable|date|after:today' // pas after_today
        ];
    }

    public function messages(): array
    {
        return
        [
        // Nom
        'name.required' => 'Le nom est obligatoire.',
        'name.string'   => 'Le nom doit être une chaîne de caractères.',
        'name.between'  => 'Le nom doit être compris entre 3 et 255 caractères.',

        // Email
        'email.required' => 'L’adresse email est obligatoire.',
        'email.email'    => 'Le format de l’email n’est pas valide.',
        'email.unique'   => 'Cet email est déjà utilisé par un autre membre.',

        // Mot de passe
        'password.required'  => 'Le mot de passe est obligatoire.',
        'password.min'       => 'Le mot de passe doit faire au moins 8 caractères.',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',

        // Score et Bannissement
        'reputation_score.required' => 'Le score de réputation est requis.',
        'reputation_score.numeric'  => 'Le score doit être un nombre.',
        'banned_at.date'            => 'La date de bannissement n’est pas valide.',
        'banned_at.after'           => 'La date de bannissement doit être une date future.',
        ];
    }
}
