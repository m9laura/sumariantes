<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\persona_tipo_persona;
use App\Models\tipo_persona;

class PersonaTipoPersonaController extends Controller
{   // Listar todas las relaciones
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $relaciones = Persona_Tipo_Persona::with(['persona', 'tipoPersona'])->get();

            // Formatear los datos para DataTables
            return datatables()->of($relaciones)
                ->addColumn('tipo_persona_actual', function ($relacion) {
                    return $relacion->tipoPersona ? $relacion->tipoPersona->nombre : 'N/A';
                })
                ->addColumn('tipo_persona_anterior', function ($relacion) {
                    return $relacion->tipoPersonaAnterior ? $relacion->tipoPersonaAnterior->nombre : 'N/A';
                })
                ->addColumn('idp', function ($relacion) {
                    return $relacion->id;
                })
                ->rawColumns(['acciones'])
                ->make(true);
        }

        // Cargar las relaciones para la vista cuando no es una solicitud AJAX
        $relaciones = Persona_Tipo_Persona::with(['persona', 'tipoPersona'])->get();
        return view('administrador.persona_tipo_personas.index', compact('relaciones'));
    }

    // Mostrar el formulario para crear una nueva relación
    public function create(Request $request)
    {
        // Verificar si la petición es de AJAX para realizar la búsqueda
        if ($request->ajax()) {
            if ($request->has('persona')) {
                return $this->searchPersonas($request);
            }

            if ($request->has('tipo_persona')) {
                return $this->searchTipoPersonas($request);
            }
        }
        $personas = Persona::all(); // Obtiene todas las personas
        $tipoPersonas = Tipo_Persona::all(); // Obtiene todos los tipos de personas
        return view('administrador.persona_tipo_personas.create', compact('personas', 'tipoPersonas'));
    }
    // Almacenar las nuevas relaciones de persona con tipo_persona
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'persona_id' => 'required|array', // Permite múltiples IDs
            'persona_id.*' => 'exists:personas,id', // Valida cada persona seleccionada
            'tipo_persona_id' => 'required|array', // Permite múltiples IDs
            'tipo_persona_id.*' => 'exists:tipo_personas,id', // Valida cada tipo de persona seleccionado
            'fecha' => 'nullable|date' // Validar la fecha opcional
        ]);

        // Almacena cada relación de persona con tipo_persona
        foreach ($request->persona_id as $personaId) {
            foreach ($request->tipo_persona_id as $tipoPersonaId) {
                Persona_Tipo_Persona::create([
                    'persona_id' => $personaId,
                    'tipo_persona_id' => $tipoPersonaId,
                    'fecha' => $request->fecha,
                    // 'user_id' => auth()->user()->id, // Almacena el ID del usuario actual si aplica
                ]);
            }
        }

        return redirect()->route('persona_tipo_personas.index')->with('success', 'Asignaciones creadas exitosamente.');
    }


    public function show(string $id)
    {
        // Muestra una relación específica
        $relacion = Persona_Tipo_Persona::with(['persona', 'tipoPersona'])->findOrFail($id);
        // Obtener todos los tipos de persona relacionados con la persona
        $tipoPersonas = $relacion->persona->tipoPersonas; // Cambiar a tipoPersonas

        return view('administrador.persona_tipo_personas.show', compact('relacion', 'tipoPersonas'));
    }
    public function edit(string $id)
    {
        $relacion = Persona_Tipo_Persona::findOrFail($id);
        $personas = Persona::all(); // Obtener todas las personas
        $tipoPersonas = Tipo_Persona::all(); // Obtener todos los tipos de personas
        return view('administrador.persona_tipo_personas.edit', compact('relacion', 'personas', 'tipoPersonas'));
    }

    // Actualiza una relación específica
    public function update(Request $request, string $id)
    {
        $relacion = Persona_Tipo_Persona::findOrFail($id);
        // Validación de los datos
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'tipo_persona_id' => 'required|exists:tipo_personas,id',
            'fecha' => 'nullable|date'
        ]);

        $relacion->update($request->all());

        return redirect()->route('persona_tipo_personas.index')->with('success', 'Registro actualizado exitosamente.');
    }
    // Elimina una relación
    public function destroy(string $id)
    {
        $relacion = Persona_Tipo_Persona::findOrFail($id);
        $relacion->delete();
        return redirect()->route('persona_tipo_personas.index')->with('success', 'Registro eliminado exitosamente.');
    }

    // Método para buscar personas
    public function searchPersonas(Request $request)
    {
        $query = $request->get('persona');
        $personas = persona::where('ci', 'LIKE', "%{$query}%")
            ->orWhere('nombre', 'LIKE', "%{$query}%")
            ->get(['id', 'ci', 'nombre']);
        return response()->json($personas);
    }

    // Método para buscar tipos de personas
    public function searchTipoPersonas(Request $request)
    {
        $query = $request->get('tipo_persona');
        $tipoPersonas = tipo_persona::where('nombre', 'LIKE', "%{$query}%")->get(['id', 'nombre']);
        return response()->json($tipoPersonas);
    }
}
