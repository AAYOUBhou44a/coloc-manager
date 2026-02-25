<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|between:3,255'
        ];
    }

    public function messages(): array
    {
        return 
        [
        'email.required' => 'Votre adresse email est nécessaire pour vous connecter.',
        'email.email'    => 'Le format de l’email n’est pas valide.',
        'email.exists'   => 'Ce compte n’existe pas encore dans notre base.',
        
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.between'  => 'Le mot de passe doit faire entre 3 et 255 caractères.',
        ];
    }
}
