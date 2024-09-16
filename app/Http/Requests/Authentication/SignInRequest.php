<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            "email"    => "required|email|exists:users,email",
            "password" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required"    => "Email field is required.",
            "email.email"       => "Please enter correct email.",
            "email.exists"      => "The provided credentials are incorrect.",
            "password.required" => "Password field is required.",
            "password.string"   => "Password field must be a string.",
        ];
    }

}
