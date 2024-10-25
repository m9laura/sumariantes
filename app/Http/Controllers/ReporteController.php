<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\caso;
use App\Models\usuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
     
//     public function indexx()
// {
//     try {
//         // Contar usuarios activos (estado 1)
//         $activeUsers = User::where('estado', 1)->count();
//     } catch (\Exception $e) {
//         dd($e->getMessage()); // Mostrar el mensaje de error
//     }

//     // Contar usuarios inactivos (estado 0)
//     $inactiveUsers = User::where('estado', 0)->count();

//     // Consultar la cantidad de personas agrupadas por tipo
//     $personCounts = DB::table('personas')
//         ->join('tipo_personas', 'personas.tipo_persona_id', '=', 'tipo_personas.id')
//         ->select('tipo_personas.nombre as tipo_persona', DB::raw('count(personas.id) as count'))
//         ->groupBy('tipo_personas.nombre')
//         ->get();

//     // Separar los nombres de los tipos de personas y sus respectivas cantidades
//     $labels = $personCounts->pluck('tipo_persona'); // Extrae los nombres de los tipos
//     $counts = $personCounts->pluck('count'); // Extrae las cantidades

//     // Pasar los datos a la vista
//     return view('administrador.reportes.index', compact('activeUsers', 'inactiveUsers', 'labels', 'counts'));
// }
 
    ///REPORTES
    public function index()

    
    {
        // Obtener la cantidad de personas por día
        $resultadosPorDiaPersona = Persona::select(DB::raw('DATE(fecha) as fecha'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy(DB::raw('DATE(fecha)'))
            ->get();

        // Obtener la cantidad de personas por semana
        $resultadosPorSemanaPersona = Persona::select(DB::raw('YEARWEEK(fecha, 1) as semana'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEARWEEK(fecha, 1)'))
            ->orderBy(DB::raw('YEARWEEK(fecha, 1)'))
            ->get();

        // Obtener la cantidad de personas por mes
        $resultadosPorMesPersona = Persona::select(DB::raw('YEAR(fecha) as año'), DB::raw('MONTH(fecha) as mes'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->orderBy(DB::raw('MONTH(fecha)'))
            ->get();
        // Obtener la cantidad de personas por año
        $resultadosPorAnioPersona = Persona::select(DB::raw('YEAR(fecha) as año'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(fecha)'))
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->get();
        // Obtener la cantidad de casos por día
        $resultadosPorDiaCaso = Caso::select(DB::raw('DATE(fecha) as fecha'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy(DB::raw('DATE(fecha)'))
            ->get();

        // Obtener la cantidad de casos por semana
        $resultadosPorSemanaCaso = Caso::select(DB::raw('YEARWEEK(fecha, 1) as semana'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEARWEEK(fecha, 1)'))
            ->orderBy(DB::raw('YEARWEEK(fecha, 1)'))
            ->get();

        // Obtener la cantidad de casos por mes
        $resultadosPorMesCaso = Caso::select(DB::raw('YEAR(fecha) as año'), DB::raw('MONTH(fecha) as mes'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'))
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->orderBy(DB::raw('MONTH(fecha)'))
            ->get();
        // Obtener la cantidad de casos por año
        $resultadosPorAnioCaso = Caso::select(DB::raw('YEAR(fecha) as año'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(fecha)'))
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->get();

        //  CASOS ESTADO  ANTECEDENTES           
        // Obtener la cantidad de casos por día con estado
        $resultadosPorDiaCasoConEstado = Caso::select(DB::raw('DATE(fecha) as fecha'), DB::raw('count(*) as total'))
            ->selectRaw('CASE WHEN LENGTH(antecedentes) > 0 THEN "Concluido" ELSE "Inconcluso" END as estado')
            ->groupBy(DB::raw('DATE(fecha)'), 'estado')
            ->orderBy(DB::raw('DATE(fecha)'))
            ->get();

        // Obtener la cantidad de casos por semana con estado
        $resultadosPorSemanaCasoConEstado = Caso::select(DB::raw('YEARWEEK(fecha, 1) as semana'), DB::raw('count(*) as total'))
            ->selectRaw('CASE WHEN LENGTH(antecedentes) > 0 THEN "Concluido" ELSE "Inconcluso" END as estado')
            ->groupBy(DB::raw('YEARWEEK(fecha, 1)'), 'estado')
            ->orderBy(DB::raw('YEARWEEK(fecha, 1)'))
            ->get();

        // Obtener la cantidad de casos por mes con estado, utilizando la fecha más reciente dentro de cada grupo
        $resultadosPorMesCasoConEstado = Caso::select(DB::raw('YEAR(fecha) as año'), DB::raw('MONTH(fecha) as mes'), DB::raw('MAX(fecha) as fecha'), DB::raw('count(*) as total'))
            ->selectRaw('CASE WHEN LENGTH(antecedentes) > 0 THEN "Concluido" ELSE "Inconcluso" END as estado')
            ->groupBy(DB::raw('YEAR(fecha)'), DB::raw('MONTH(fecha)'), 'estado')
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->orderBy(DB::raw('MONTH(fecha)'))
            ->get();
        // Obtener la cantidad de casos por año con estado
        $resultadosPorAnioCasoConEstado = Caso::select(DB::raw('YEAR(fecha) as año'), DB::raw('count(*) as total'))
            ->selectRaw('CASE WHEN LENGTH(antecedentes) > 0 THEN "Concluido" ELSE "Inconcluso" END as estado')
            ->groupBy(DB::raw('YEAR(fecha)'), 'estado')
            ->orderBy(DB::raw('YEAR(fecha)'))
            ->get();

        // Formatear los resultados de casos por estado
        // Formateo por día
        $resultadosPorDiaCasoConEstado = $resultadosPorDiaCasoConEstado->map(function ($item) {
            $item->fecha = date('Y-m-d', strtotime($item->fecha));
            return $item;
        });

        // Formateo por semana
        $resultadosPorSemanaCasoConEstado = $resultadosPorSemanaCasoConEstado->map(function ($item) {
            return [
                'semana' => $item->semana,
                'estado' => $item->estado,
                'total' => $item->total
            ];
        });
        // Formateo por mes 
        $resultadosPorMesCasoConEstado = $resultadosPorMesCasoConEstado->map(function ($item) {
            return [
                'fecha' => $item->año . '-' . str_pad($item->mes, 2, '0', STR_PAD_LEFT),
                'estado' => $item->estado,
                'total' => $item->total,
            ];
        });
        // Formateo por año
        $resultadosPorAnioCasoConEstado = $resultadosPorAnioCasoConEstado->map(function ($item) {
            return [
                'año' => $item->año,
                'estado' => $item->estado,
                'total' => $item->total,
            ];
        });
        /////////////////////////////////////////////////////////////////////////////////////////
        // Formatear las fechas para JavaScript
        $resultadosPorDiaPersona = $resultadosPorDiaPersona->map(function ($item) {
            $item->fecha = date('Y-m-d', strtotime($item->fecha));
            return $item;
        });

        $resultadosPorSemanaPersona = $resultadosPorSemanaPersona->map(function ($item) {
            return ['semana' => $item->semana, 'total' => $item->total];
        });

        $resultadosPorMesPersona = $resultadosPorMesPersona->map(function ($item) {
            return [
                'fecha' => $item->año . '-' . str_pad($item->mes, 2, '0', STR_PAD_LEFT),
                'total' => $item->total
            ];
        });
        $resultadosPorAnioPersona = $resultadosPorAnioPersona->map(function ($item) {
            return [
                'año' => $item->año,
                'total' => $item->total
            ];
        });
        //PARA CASOS DIA ,SEMNA, MES Y AÑO
        $resultadosPorDiaCaso = $resultadosPorDiaCaso->map(function ($item) {
            $item->fecha = date('Y-m-d', strtotime($item->fecha));
            return $item;
        });

        $resultadosPorSemanaCaso = $resultadosPorSemanaCaso->map(function ($item) {
            return ['semana' => $item->semana, 'total' => $item->total];
        });

        $resultadosPorMesCaso = $resultadosPorMesCaso->map(function ($item) {
            return [
                'fecha' => $item->año . '-' . str_pad($item->mes, 2, '0', STR_PAD_LEFT),
                'total' => $item->total
            ];
        });
        $resultadosPorAnioCaso = $resultadosPorAnioCaso->map(function ($item) {
            return [
                'año' => $item->año,
                'total' => $item->total
            ];
        });
        return view('administrador.reportes.index', [
            'resultadosPorDiaPersona' => $resultadosPorDiaPersona,
            'resultadosPorSemanaPersona' => $resultadosPorSemanaPersona,
            'resultadosPorMesPersona' => $resultadosPorMesPersona,
            'resultadosPorAnioPersona' => $resultadosPorAnioPersona,
            'resultadosPorDiaCaso' => $resultadosPorDiaCaso,
            'resultadosPorSemanaCaso' => $resultadosPorSemanaCaso,
            'resultadosPorMesCaso' => $resultadosPorMesCaso,
            'resultadosPorAnioCaso' => $resultadosPorAnioCaso,
            'resultadosPorDiaCasoConEstado' => $resultadosPorDiaCasoConEstado,
            'resultadosPorSemanaCasoConEstado' => $resultadosPorSemanaCasoConEstado,
            'resultadosPorMesCasoConEstado' => $resultadosPorMesCasoConEstado,
            'resultadosPorAnioCasoConEstado' =>   $resultadosPorAnioCasoConEstado,

        ]);
    }
}

