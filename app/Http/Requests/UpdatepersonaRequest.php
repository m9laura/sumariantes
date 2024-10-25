<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatepersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'between:3,30'], //, 'no_repeated_chars'
            'apellidop' => ['required', 'string', 'between:3,30'], //, 'no_repeated_chars'
            'apellidom' => ['string', 'between:3,30'], //, 'no_repeated_chars'
            'genero' => 'required',
            'fnacimiento' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $fechaNacimiento = Carbon::parse($value);
                        $edad = $fechaNacimiento->age;
    
                        if ($edad < 18) {
                            $fail('Debes tener al menos 18 años.');
                        }
    
                        if ($edad > 75) {
                            $fail('No puedes tener más de 75 años.');
                        }
    
                        // Verificar la fecha máxima permitida
                        $fechaActual = Carbon::now();
                        if ($fechaNacimiento->greaterThan($fechaActual)) {
                            $fail('La fecha de nacimiento no puede estar en el futuro.');
                        }
                    }
                },
            ],
            'whatsapp' => 'required|string|max:15',
            'sancion_ids' => 'array', // Asegúrate de que sea un arreglo
            'sancion_ids.*' => 'exists:sancions,id', // Verifica que cada ID de sanción exista
        ];
    }
}