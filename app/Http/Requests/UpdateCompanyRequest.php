<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $companyId = $this->route('company');

        return [
            'name' => ['sometimes', 'string'],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('companies', 'email')->ignore($companyId)
            ],
            'logo' => [
                'sometimes',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'dimensions:min_width=100,min_height=100'
            ],
            'website' => ['sometimes', 'nullable', 'url'],
        ];
    }
}
