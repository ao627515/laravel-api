<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUserRequest extends FormRequest
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
            'email' => ['required', 'email','exists:users,email'],
            'password' => ['required', 'string'],
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
            'email.required' => 'L\'adresse e-mail est requise',
            'email.email' => 'L\'adresse e-mail n\'est pas valide',
            'email.exists' => 'L\'adresse e-mail n\'existes pas',
            'password.required' => 'Le nom est requis'
        ];
    }
}
