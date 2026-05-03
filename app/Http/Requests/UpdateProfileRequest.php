<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone_number' => [
                'nullable',
                'string',
                'size:11',
                'regex:/^0(70|80|81|90|91)\d{8}$/',
            ],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'Please enter your first name.',
            'surname.required' => 'Please enter your surname.',
            'phone_number.size' => 'Phone number must be 11 digits.',
            'phone_number.regex' => 'Phone number must start with 070, 080, 081, 090, or 091.',
            'profile_picture.image' => 'Profile picture must be an image.',
            'profile_picture.max' => 'Profile picture must not be larger than 2MB.',
        ];
    }
}
