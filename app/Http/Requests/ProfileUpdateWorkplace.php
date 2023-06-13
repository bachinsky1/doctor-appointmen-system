<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateWorkplace extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'workplaces' => 'required|array',
            'workplaces.*.user_id' => 'required|integer',
            'workplaces.*.medicalestablishment_id' => 'required|integer',
            'workplaces.*.position_id' => 'nullable|integer',
        ];
    }
}