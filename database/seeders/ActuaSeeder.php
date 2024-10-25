<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\actua;

class ActuaSeeder extends Seeder
{

    public function run(): void
    {
        $actuas = [
            [
                'nombre' => 'Solicitud Caso 2/Expediente 1235 de Juan Pérez',
                'descripcion' => 'Se requieren los siguientes documentos para el caso número 1: Acta de nacimiento, comprobante de domicilio y CURP.',
                'fecha' => '2024-09-10',
                'documentos' => 'okey', // Ruta de ejemplo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Solicitud Caso 3/Expediente 4567 de María Gómez',
                'descripcion' => 'Requerimiento de documentos para el caso número 2: Identificación oficial, recibo de pago y contrato de servicio.',
                'fecha' => '2024-10-10',
                'documentos' => 'okey', // Ruta de ejemplo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Solicitud Caso 4/Expediente 8910 de Carlos Ramírez',
                'descripcion' => 'Documentación necesaria para el caso número 3: Carta poder, declaración jurada y constancia de no antecedentes penales.',
                'fecha' => '2024-09-15',
                'documentos' => 'okey', // Ruta de ejemplo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Solicitud Caso 5/Expediente 1121 de Laura Fernández',
                'descripcion' => 'Por favor, enviar los documentos para el caso número 4: Comprobante de ingresos, identificación y firma del solicitante.',
                'fecha' => '2024-08-25',
                'documentos' => 'okey', // Ruta de ejemplo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Solicitud Caso 6/Expediente 3141 de Andrés Martínez',
                'descripcion' => 'Se solicitan los siguientes papeles para el caso número 5: Informe médico, autorización de tratamiento y prueba de identidad.',
                'fecha' => '2024-09-20',
                'documentos' => 'okey', // Ruta de ejemplo
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        actua::insert($actuas);
    }
}
