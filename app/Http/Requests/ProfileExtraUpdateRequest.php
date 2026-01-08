<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileExtraUpdateRequest extends FormRequest
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
            'about' => ['nullable', 'string', 'max:1000'],
            'portfolio_path' => ['nullable', 'url', 'max:2048'],
            'cv_path' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
        ];
    }
}
