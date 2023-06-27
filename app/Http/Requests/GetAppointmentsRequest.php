<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetAppointmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && $user->isA('healthcare') || $user->isA('patient');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start' => ['required', 'date_format:Y-m-d\TH:i:sP', 'before_or_equal:end'],
            'end' => ['required', 'date_format:Y-m-d\TH:i:sP', 'after_or_equal:start'],
        ];
    }
}
