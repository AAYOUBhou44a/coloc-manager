<?php

namespace App\Http\Requests;

use App\Models\ColocationUser;
use DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    protected function prepareForValidation(){
        $colocation_id =  \DB::table('colocation_user')->where('user_id', Auth::id())->value('colocation_id');
        $this->merge([
            'colocation_id' => $colocation_id
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required','between:3,255',Rule::unique('categories')->where(function ($query){$query->where('colocation_id', $this->colocation_id);})],
            'colocation_id' => 'required|exists:colocations,id'
        ];
    }
}
