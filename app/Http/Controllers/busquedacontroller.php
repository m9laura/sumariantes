<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\sancion;
use App\Models\caso;
use App\Models\sancionpersonas;
use App\Models\tipo_caso;
use App\Models\caso_actuado;
use App\Models\Actua;
use Illuminate\Support\Facades\Validator;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {

    // Validación de entrada
    $request->validate([
        'search_persona' => 'nullable|string|max:255',
        'search_sancion' => 'nullable|string|max:255',
        'search_caso' => 'nullable|string|max:255',
    ]);

    // Recoger términos de búsqueda
    $searchPersona = $request->input('search_persona');
    $searchSancion = $request->input('search_sancion');
    $searchCaso = $request->input('search_caso');
        // Búsqueda de Personas
        $personas = Persona::with(['casos', 'sancionpersonas', 'tipoPersonas']) // Cargar sanciones también
            ->when($searchPersona, function ($query) use ($searchPersona) {
                return $query->where(function ($q) use ($searchPersona) {
                    $q->where('nombre', 'LIKE', "%{$searchPersona}%")
                        ->orWhere('apellidop', 'LIKE', "%{$searchPersona}%")
                        ->orWhere('ci', 'LIKE', "%{$searchPersona}%")
                        ->orWhere('apellidom', 'LIKE', "%{$searchPersona}%");
                });
            })
            // Añadir búsqueda por caso
            ->when($searchCaso, function ($query) use ($searchCaso) {
                return $query->whereHas('casos', function ($q) use ($searchCaso) {
                    $q->where('identificacion_caso', 'LIKE', "%{$searchCaso}%")
                        ->orWhere('exp_adm', 'LIKE', "%{$searchCaso}%");
                });
            })
            // Añadir búsqueda por sanción
            ->when($searchSancion, function ($query) use ($searchSancion) {
                return $query->whereHas('sancionpersonas', function ($q) use ($searchSancion) {
                    $q->where('nombre', 'LIKE', "%{$searchSancion}%")
                        ->orWhere('descripcion', 'LIKE', "%{$searchSancion}%");
                });
            })
            ->get();

        // Búsqueda de Sanciones
        // Búsqueda de Sanciones
        $sanciones = Sancion::with('sancionpersonas') // Cargar personas relacionadas
            ->when($searchSancion, function ($query) use ($searchSancion) {
                return $query->where('sancions.nombre', 'LIKE', "%{$searchSancion}%")
                    ->orWhere('sancions.descripcion', 'LIKE', "%{$searchSancion}%");
            })
            ->get();

        // Búsqueda de Casos
        $casos = Caso::with(['tipoCaso', 'personas'])
            ->when($searchCaso, function ($query) use ($searchCaso, $searchPersona) {
                return $query->where('identificacion_caso', 'LIKE', "%{$searchCaso}%")
                    ->orWhere('exp_adm', 'LIKE', "%{$searchCaso}%")
                    ->orWhereHas('personas', function ($q) use ($searchPersona) {
                        // Solo ejecutar si hay un término de búsqueda de persona
                        if (!empty($searchPersona)) {
                            $q->where('nombre', 'LIKE', "%{$searchPersona}%")
                                ->orWhere('apellidop', 'LIKE', "%{$searchPersona}%")
                                ->orWhere('ci', 'LIKE', "%{$searchPersona}%")
                                ->orWhere('apellidom', 'LIKE', "%{$searchPersona}%");
                        }
                    });
            })
            ->get();

        return view('administrador.busqueda.index', compact('personas', 'sanciones', 'casos'));
    }
}