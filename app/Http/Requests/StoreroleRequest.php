<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreroleRequest extends FormRequest
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
            //'name' => ['required', 'string', 'between:3,30'],//, 'no_repeated_chars'
            //'estado' => 'required'
        ];
    }
}