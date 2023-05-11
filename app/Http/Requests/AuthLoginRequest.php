<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:5|max:25'
        ];
    }

    public function messages()
    {
        return [
            'email' => [
                'required' => 'email tidak boleh kosong!',
                'email' => 'email tidak valid'
            ],
            'password' => [
                'required' => 'password tidak boleh kosong!',
                'min' => 'password minimal 5 karakter',
                'max' => 'password maksimal 25 karakter'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => true,
            'message' => $validator->errors()->first()
        ], 400));
    }
}
