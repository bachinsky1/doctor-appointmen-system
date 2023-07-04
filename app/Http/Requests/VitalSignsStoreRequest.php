<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VitalSignsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && $user->isA('healthcare');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'units.heartbeat' => ['nullable', 'numeric'],
            'units.temperature' => ['nullable', 'numeric'],
            'units.pressure' => ['nullable', 'numeric'],
            'units.breathing_rate' => ['nullable', 'numeric'],
            'units.peak_flow' => ['nullable', 'numeric'],
            'units.saturation' => ['nullable', 'numeric'],
            'units.pt' => ['nullable', 'numeric'],
            'units.glucose' => ['nullable', 'numeric'],
            'units.hba1c' => ['nullable', 'numeric'],
            'public_id' => ['nullable', 'string'],
            'patient_id' => ['nullable', 'numeric'],
            'user_id' => ['nullable', 'numeric'],
        ];
    }
}
