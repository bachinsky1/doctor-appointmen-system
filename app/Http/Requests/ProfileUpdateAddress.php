<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAddress extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'addresses' => 'required|array',
            'addresses.*.street' => 'required|string|max:255',
            'addresses.*.house_number' => 'required|string|max:255',
            'addresses.*.city' => 'required|string|max:255',
            'addresses.*.state' => 'required|string|max:255',
            'addresses.*.zip_code' => 'required|string|max:255',
            'addresses.*.is_main_address' => 'required|boolean',
        ];
    }
}