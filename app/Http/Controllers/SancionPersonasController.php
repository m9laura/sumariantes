<?php

namespace App\Http\Controllers;

use App\Models\sancionpersonas;
use App\Http\Requests\StoresancionpersonasRequest;
use App\Http\Requests\UpdatesancionpersonasRequest;
use App\Models\persona;
use App\Models\sancion;
use Illuminate\Http\Request;
class SancionpersonasController extends Controller
{
    public function index(Request $request)
    { // Obtener todos los registros, incluyendo relaciones
        $Sancionpersonas = sancionpersonas::with(['persona', 'sancion'])->get();
        return view('administrador.sancion_personas.index', compact('Sancionpersonas'));
    }
    public function create(Request $request)
    {
          // Verificar si la petición es de AJAX para realizar la búsqueda
          if ($request->ajax()) {
            if ($request->has('persona')) {
                return $this->searchPersonas($request);
            }

            if ($request->has('sancion')) {
                return $this->searchSanciones($request);
            }
        }

        $personas = Persona::all();
        $sanciones = Sancion::all();
        return view('administrador.sancion_personas.create', compact('personas', 'sanciones'));
    }
    public function store(Request $request)
    { 
        $request->validate([
            'persona_id' => 'required|array|min:1', // Cambia esto para permitir múltiples selecciones
            'persona_id.*' => 'exists:personas,id', // Validación para cada ID de persona
            'sancion_id' => 'required|array|min:1', // Cambia esto para permitir múltiples selecciones
            'sancion_id.*' => 'exists:sancions,id', // Validación para cada ID de sanción
            'fecha' => 'nullable|date',
        ]);
        // Guardar sanciones para cada persona seleccionada
        foreach ($request->persona_id as $personaId) {
            foreach ($request->sancion_id as $sancionId) {
                sancionpersonas::create([
                    'persona_id' => $personaId,
                    'sancion_id' => $sancionId,
                    'fecha' => $request->fecha,
                ]);
            }
        }
    
        return redirect()->route('sancion_personas.index')->with('success', 'Sanciones asignadas con éxito.');
    }
    
    public function show($id)
    { 
        // Cargar la sanción específica junto con la persona asociada
         // Cargar la sanción específica junto con la persona y todas sus sanciones asociadas
        $Sancionpersonas = sancionpersonas::with(['persona','sancion'])->findOrFail($id);
         // Cargar las sanciones relacionadas con la persona
         // Cargar la sanción específica de esta entrada
        // Retorna la vista con los detalles de la persona y sus sanciones
        return view('administrador.sancion_personas.show', compact('Sancionpersonas'));
    }

    public function edit($id)
    {
         // Obtener la sanción específica
    $Sancionpersonas = sancionpersonas::with('sancion')->findOrFail($id);

        // Obtener todas las sanciones de la persona asociada a esta sanción
        $sancionesPersona = sancionpersonas::where('persona_id', $Sancionpersonas->persona_id)
                                ->with('sancion') // Incluye detalles de las sanciones
                                ->get();
    
        // Obtener las opciones para el formulario
        $personas = Persona::all();
        $sanciones = Sancion::all();
    
        // Retornar la vista con todas las sanciones de la persona
        return view('administrador.sancion_personas.edit', compact('Sancionpersonas', 'sancionesPersona', 'personas', 'sanciones'));
    }

    public function update(Request $request, $id)
    { // Validar y actualizar la sanción
        $request->validate([
            //'persona_id' => 'required|exists:personas,id',
            'sancion_id' => 'required|exists:sancions,id',
            'fecha' => 'nullable|date',
        ]);

        $Sancionpersonas = sancionpersonas::findOrFail($id);
        $Sancionpersonas->update($request->all());
        return redirect()->route('sancion_personas.index')->with('success', 'Sanción actualizada con éxito.');
    }

    public function destroy($id)
    {
       // Eliminar una sanción
       $Sancionpersonas = sancionpersonas::findOrFail($id);
       $Sancionpersonas->delete();
        return redirect()->route('sancion_personas.index')->with('success', 'Sanción eliminada con éxito.');
    }
   
  
    // Método para buscar personas
    public function searchPersonas(Request $request)
    {
        $query = $request->get('persona');
        $personas = Persona::where('ci', 'LIKE', "%{$query}%")
                           ->orWhere('nombre', 'LIKE', "%{$query}%")
                           ->get(['id', 'ci', 'nombre']);
        return response()->json($personas);
    }

    // Método para buscar sanciones
    public function searchSanciones(Request $request)
    {
        $query = $request->get('sancion');
        $sanciones = Sancion::where('nombre', 'LIKE', "%{$query}%")->get(['id', 'nombre']);
        return response()->json($sanciones);
    }
      // Método para agregar una nueva sanción
      public function addSancion(Request $request, $id)
      {
          $request->validate([
              'sancion_id' => 'required|exists:sancions,id',
              'fecha' => 'nullable|date',
          ]);
  
          // Agregar la nueva sanción para la persona
          $sancionPersona = sancionpersonas::findOrFail($id);
          sancionpersonas::create([
              'persona_id' => $sancionPersona->persona_id,
              'sancion_id' => $request->sancion_id,
              'fecha' => $request->fecha,
          ]);
  
          return redirect()->route('sancion_personas.edit', $sancionPersona->id)->with('success', 'Sanción añadida con éxito.');
      }
    
}
