<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB; // Asegúrate de importar el facade DB
class StorepersonaRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'between:3,30'], // Campo obligatorio
            'apellidop' => ['nullable', 'string', 'between:3,30'], // No obligatorio
            'apellidom' => ['nullable', 'string', 'between:3,30'], // No obligatorio
           'ci' => 'nullable|integer|unique:personas,ci|digits_between:7,12',// Asegúrate de que el valor esté en el rango válido
            'genero' => ['required', 'boolean'], // Booleano requerido
            'nacionalidad' => 'nullable|string|max:30', // Opcional, máximo 30 caracteres
            'whatsapp' => [
                'nullable',
                'string',
                'digits_between:7,15', // Para que tenga entre 7 y 15 dígitos si es proporcionado
                function ($attribute, $value, $fail) {
                    // Solo valida la unicidad si hay un valor en el campo
                    if (!empty($value)) {
                        $exists =DB::table('personas')->where('whatsapp', $value)->exists();
                        if ($exists) {
                            $fail('El número de WhatsApp ya está registrado.');
                        }
                    }
                },
            ],
            'fnacimiento' => [
                'nullable', // Primero, especifica la regla 'nullable'
                'date',     // Luego, especifica la regla 'date'
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
                    }
                }
            ],
            'tipo_persona_ids' => 'nullable|array', // Haciendo que no sea obligatorio
            'tipo_persona_ids.*' => 'exists:tipo_personas,id', // Asegúrate de que los IDs existan
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:8048', // Foto opcional, máximo 8MB
        ];
    }
}
