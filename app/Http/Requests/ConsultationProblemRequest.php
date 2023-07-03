<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConsultationProblemRequest extends FormRequest
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
            'problem.hierarchy_level' => ['required', 'integer', 'min:0', 'max:255'],
            'problem.classification_place' => ['required', 'string', 'in:T,N'],
            'problem.terminal_type' => ['required', 'string', 'in:X,S'],
            'problem.chapter_id' => ['required', 'integer', 'exists:icd10_chapters,id'],
            'problem.code1' => ['required', 'string', 'max:3'],
            'problem.code2' => ['required', 'string', 'max:6'],
            'problem.code3' => ['required', 'string', 'max:6'],
            'problem.code4' => ['required', 'string', 'max:6'],
            'problem.title1' => ['required', 'string', 'max:255'],
            'problem.title2' => ['required', 'string', 'max:255'],
            'problem.title3' => ['required', 'string', 'max:255'],
            'problem.reference1' => ['nullable', 'string', 'max:50'],
            'problem.reference2' => ['nullable', 'string', 'max:50'],
            'problem.reference3' => ['nullable', 'string', 'max:50'],
            'problem.reference4' => ['nullable', 'string', 'max:50'],
            'problem.reference5' => ['nullable', 'string', 'max:50'],
            'problem.reference6' => ['nullable', 'string', 'max:50'],
            'public_id' => 'required|string|max:255',
        ];
    }
}
