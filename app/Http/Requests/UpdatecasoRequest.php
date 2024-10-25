<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecasoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'mae' => 'nullable|file|mimes:pdf|max:10240', // máximo 10 MB
            'hoja_ruta' => 'nullable|file|mimes:pdf|max:10240', // máximo 10 MB
            // Otras reglas...
        ];
    }
}
