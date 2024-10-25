<?php

namespace Database\Seeders;

use App\Models\sancion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SancionSeeder extends Seeder
{

    public function run(): void
    {
       
            $sanciones = [
                [
                    'nombre' => 'Advertencia',
                    'descripcion' => 'Primera advertencia por incumplimiento de normas.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Suspensión Temporal',
                    'descripcion' => 'Suspensión temporal de actividades por 30 días.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Multa',
                    'descripcion' => 'Imposición de multa económica por violación de normativas.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Inhabilitación',
                    'descripcion' => 'Inhabilitación para ejercer funciones por 6 meses.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Despido',
                    'descripcion' => 'Despido por razones de incumplimiento grave.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Rehabilitación',
                    'descripcion' => 'Proceso de rehabilitación después de la sanción.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Amonestación Escrita',
                    'descripcion' => 'Amonestación escrita por falta leve.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Capacitación Obligatoria',
                    'descripcion' => 'Asistencia a capacitación obligatoria.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Revisión de Expediente',
                    'descripcion' => 'Revisión del expediente por irregularidades.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Sanción Administrativa',
                    'descripcion' => 'Sanción administrativa por mal manejo.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Sanción de Tiempo',
                    'descripcion' => 'Sanción de tiempo por retrasos en los plazos establecidos.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Requerimiento Formal',
                    'descripcion' => 'Requerimiento formal para corregir acciones no conformes.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Suspensión de Beneficios',
                    'descripcion' => 'Suspensión de beneficios por incumplimiento.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Retiro de Licencia',
                    'descripcion' => 'Retiro de licencia temporal para actividades específicas.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Sanción por Falta de Documentación',
                    'descripcion' => 'Sanción por falta de presentación de documentación requerida.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Apertura de Proceso Disciplinario',
                    'descripcion' => 'Apertura de un proceso disciplinario por conductas inapropiadas.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Sanción de Suspensión Definitiva',
                    'descripcion' => 'Suspensión definitiva de funciones por incumplimiento grave.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Advertencia Escrita',
                    'descripcion' => 'Advertencia escrita por falta leve.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Programa de Corrección',
                    'descripcion' => 'Asignación a un programa de corrección de conductas.',
                    'estado' => true,
                    'fecha' => now(),
                ],
                [
                    'nombre' => 'Devolución de Recursos',
                    'descripcion' => 'Devolución de recursos por uso indebido.',
                    'estado' => true,
                    'fecha' => now(),
                ],
            ];
    
            // Insertar las sanciones en la base de datos
           
            sancion::insert($sanciones);
        }
    

}
