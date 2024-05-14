<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required']
        ];
    }

    public function failedValidation(Validator $validator){
        return throw new HttpResponseException(response()->json([
            'stats' => 422,
            'success' => false,
            'error' => true,
            'message' => 'Validation errors',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.string' => 'Le nom doit être une chaîne de caractères',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères',
            'email.required' => 'L\'adresse e-mail est requise',
            'email.email' => 'L\'adresse e-mail n\'est pas valide',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée',
            'password.required' => 'Le nom est requis'
        ];
    }

}
