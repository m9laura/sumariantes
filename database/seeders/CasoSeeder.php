<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\caso;

class CasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
           
            // Define los datos que deseas insertar
            $casos = [
                [
                    'exp_adm' => 'AB1234',
                    'registro_auxiliar' => 'wef123',
                    'identificacion_caso' => 'Caso 001',
                    'mae' => 'public/img/11.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 001',
                    'resolucion_final' => 'Resolución del caso 001',
                    'hoja_ruta' => 'public/img/11.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 001',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 001',
                    'ejecutoria' => 'Ejecutoria de caso 001',
                    'antecedentes' => 'completado',
                    'estado_proceso' => 'Concluido',
                    'fecha' => now()->subMonth()->toDateString(), // Fecha de un mes antes
                ],
                [
                    'exp_adm' => 'CD5678',
                    'registro_auxiliar' => 'xyz456',
                    'identificacion_caso' => 'Caso 002',
                    'mae' => 'public/img/12.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 002',
                    'resolucion_final' => 'Resolución del caso 002',
                    'hoja_ruta' => 'public/img/12.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 002',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 002',
                    'ejecutoria' => 'Ejecutoria de caso 002',
                    'antecedentes' => 'en progreso',
                    'estado_proceso' => 'Abierto',
                    'fecha' => now()->subDays(15)->toDateString(), // Fecha de 15 días antes
                ],
                [
                    'exp_adm' => 'EF9101',
                    'registro_auxiliar' => 'abc789',
                    'identificacion_caso' => 'Caso 003',
                    'mae' => 'public/img/13.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 003',
                    'resolucion_final' => 'Resolución del caso 003',
                    'hoja_ruta' => 'public/img/13.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 003',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 003',
                    'ejecutoria' => 'Ejecutoria de caso 003',
                    'antecedentes' => 'pendiente',
                    'estado_proceso' => 'En revisión',
                    'fecha' => now()->subWeeks(2)->toDateString(), // Fecha de 2 semanas antes
                ],
                [
                    'exp_adm' => 'GH1234',
                    'registro_auxiliar' => 'qwe234',
                    'identificacion_caso' => 'Caso 004',
                    'mae' => 'public/img/14.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 004',
                    'resolucion_final' => 'Resolución del caso 004',
                    'hoja_ruta' => 'public/img/14.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 004',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 004',
                    'ejecutoria' => 'Ejecutoria de caso 004',
                    'antecedentes' => 'cerrado',
                    'estado_proceso' => 'Concluido',
                    'fecha' => now()->subDays(10)->toDateString(), // Fecha de 10 días antes
                ],
                [
                    'exp_adm' => 'KL9101',
                    'registro_auxiliar' => 'abc456',
                    'identificacion_caso' => 'Caso 006',
                    'mae' => 'public/img/16.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 006',
                    'resolucion_final' => 'Resolución del caso 006',
                    'hoja_ruta' => 'public/img/16.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 006',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 006',
                    'ejecutoria' => 'Ejecutoria de caso 006',
                    'antecedentes' => 'nuevo',
                    'estado_proceso' => 'Abierto',
                    'fecha' => now()->subDays(20)->toDateString(), // Fecha de 20 días antes
                ],
                [
                    'exp_adm' => 'MN2345',
                    'registro_auxiliar' => 'def789',
                    'identificacion_caso' => 'Caso 007',
                    'mae' => 'public/img/17.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 007',
                    'resolucion_final' => 'Resolución del caso 007',
                    'hoja_ruta' => 'public/img/17.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 007',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 007',
                    'ejecutoria' => 'Ejecutoria de caso 007',
                    'antecedentes' => 'en revisión',
                    'estado_proceso' => 'Pendiente',
                    'fecha' => now()->subDays(30)->toDateString(), // Fecha de 30 días antes
                ],
                [
                    'exp_adm' => 'OP3456',
                    'registro_auxiliar' => 'ghi012',
                    'identificacion_caso' => 'Caso 008',
                    'mae' => 'public/img/18.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 008',
                    'resolucion_final' => 'Resolución del caso 008',
                    'hoja_ruta' => 'public/img/18.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 008',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 008',
                    'ejecutoria' => 'Ejecutoria de caso 008',
                    'antecedentes' => 'completado',
                    'estado_proceso' => 'Concluido',
                    'fecha' => now()->subDays(8)->toDateString(), // Fecha de 8 días antes
                ],
                [
                    'exp_adm' => 'QR4567',
                    'registro_auxiliar' => 'jkl345',
                    'identificacion_caso' => 'Caso 009',
                    'mae' => 'public/img/19.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 009',
                    'resolucion_final' => 'Resolución del caso 009',
                    'hoja_ruta' => 'public/img/19.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 009',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 009',
                    'ejecutoria' => 'Ejecutoria de caso 009',
                    'antecedentes' => 'en progreso',
                    'estado_proceso' => 'Abierto',
                    'fecha' => now()->subDays(12)->toDateString(), // Fecha de 12 días antes
                ],
                [
                    'exp_adm' => 'IJ5678',
                    'registro_auxiliar' => 'rty567',
                    'identificacion_caso' => 'Caso 005',
                    'mae' => 'public/img/15.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso 005',
                    'resolucion_final' => 'Resolución del caso 005',
                    'hoja_ruta' => 'public/img/15.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria para caso 005',
                    'recurso_jerarquico' => 'Recurso jerárquico para caso 005',
                    'ejecutoria' => 'Ejecutoria de caso 005',
                    'antecedentes' => 'revisado',
                    'estado_proceso' => 'Pendiente',
                    'fecha' => now()->subDays(5)->toDateString(), // Fecha de 5 días antes
                ],
                [
                    'exp_adm' => 'MQL12',
                    'registro_auxiliar' => 'LQM21',
                    'identificacion_caso' => 'PROBABLE  INCUMPLIMIENTO D/SRCC/001/2021 DE FECHA 7 DE MAYO DE 2021 EMITIDO POR LA SRA. SOLEDAD CARRERA COLQUE CONTROL DE PERSONA DE LA U.P. Y C., E INFORME GAMEA/DTH/UAL/JVCM/17/2021 DE LA FECHA 10 DE JUNIO DE 2021 EMITIDO POR EL ABG. JUAN CARLOS VILLA MAMANI QUE REFIERE  "LA EMISION DE MEMORANDUM POR INASISTENCIA DEL EX SERVIDOR PUBLICO REYNALDO RUMAY ALAVI QUISPE, QUIEN HABRIA FALLECIDO EN EL MES DE ABRIL DE 2021" ADEMAS DE HABER ELABORADO LA PLANILLA DE PAGOS DE LOS MESES DE MAYO, JUNIO, JULIO, AGOSTO Y SEPTIEMBR  DE 2021. ',
                    'mae' => 'public/img/11.jpg',
                    'apertura_inicial' => 'Apertura inicial del caso con detalles importantes',
                    'resolucion_final' => 'Resolución  Inicial de Apertura de Sumario Administrativo Interno GAMEA/AUT.SUM./LYGT/N°001/2022 de fecha 20 de enero de 2022, RESUELVE: ARTÍCULO PRIMERO.- Disponer el inicio de proceso sumario interno en contra de los ex y/o servidores públicos: JUAN CARLOS TICONA CHAMBI, DAYNOR ARMANDO MACHICADO ROJAS, VERONICA MENDOZA CACERES, ANTONIO JOSE RODRIGUEZ MANZANO, FREDY FRNCO ALCON VARGAS, HENRRY KEVIN QUISBERT GARCIA',
                    'hoja_ruta' => 'public/img/11.jpg',
                    'recurso_revocatoria' => 'Recurso de revocatoria presentado',
                    'recurso_jerarquico' => 'RESOLUCIÓN SUMARIAL DE RECURSO JERARQUICA EXPEDIENTE ADMIISTRATIVO  Nº 001/22 de fecha 14 de junio de 2022 RESUELVEARTÍCULO PRIMERO.- COMFIRMAR ',
                    'ejecutoria' => 'ejecutoriada en la fecha 25 de julio de 2022',
                    'antecedentes' => 'Carpeta Principal 1 cuerpo de fs. 01 a fs. 211   2 cuerpo de fs. 212 a 411 fs  3 cuerpo de fs. 412 a 6154 cuerpo de fs. 616 a 903 5 cueerpo   fs. 904 a 1124',
                    'estado_proceso' => 'Pendiente',
                    'fecha' => now(),
                ],
            ];
            
            // Guardar en la base de datos
            foreach ($casos as $casoData) {
                try {
                    Caso::create($casoData); // Asegúrate de que el nombre de la clase es correcto
                } catch (\Exception $e) {
                    // Manejo del error
                    dd($e->getMessage());
                }
            }
        }
    }