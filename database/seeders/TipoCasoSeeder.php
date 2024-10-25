<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tipo_caso;
use Carbon\Carbon;

class TipoCasoSeeder extends Seeder
{
 
    public function run(): void
    {  // Definir los casos
        $tipocasos = [
            [
                'nombre' => 'Caso Económico',
                'descripcion' => 'Incumplimiento relacionado con asuntos financieros.',
                'estado' => true,
                'gravedad' => 1, // Económico
                'fecha' => Carbon::now(),
            ],
            [
                'nombre' => 'Días de Impedimento',
                'descripcion' => 'Incumplimiento que resultó en días de impedimento laboral.',
                'estado' => true,
                'gravedad' => 2, // Días de impedimento
                'fecha' => Carbon::now(),
            ],
            [
                'nombre' => 'Destitución',
                'descripcion' => 'Incumplimiento grave que llevó a la destitución del cargo.',
                'estado' => true,
                'gravedad' => 3, // Destitución
                'fecha' => Carbon::now(),
            ],
            [
                'nombre' => 'Caso Menor',
                'descripcion' => 'Falta leve sin mayores consecuencias.',
                'estado' => true,
                'gravedad' => 1, // Económico
                'fecha' => Carbon::now(),
            ],
            [
                'nombre' => 'Caso Grave',
                'descripcion' => 'Incumplimiento que resultó en la suspensión temporal.',
                'estado' => true,
                'gravedad' => 3, // Destitución
                'fecha' => Carbon::now(),
            ],
        ];

        // Insertar los casos en la base de datos
        tipo_caso::insert($tipocasos);
    }
}