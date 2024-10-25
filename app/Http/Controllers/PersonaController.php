<?php

namespace App\Http\Controllers;

use App\Models\persona;
use App\Http\Requests\StorepersonaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatepersonaRequest;
use App\Models\tipo_persona;
use App\Models\sancion;
use App\Models\caso;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
class PersonaController extends Controller
{
    public function update(UpdatePersonaRequest $request, Persona $persona)
    { // Depuración: Verifica que los datos se estén enviando correctamente
        // dd($request->all());
        // Si el request tiene una nueva foto, manejar la actualización
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($persona->foto && Storage::exists('public/' . $persona->foto)) {
                Storage::delete('public/' . $persona->foto);
            }
            // Guardar la nueva foto
            $path = $request->file('foto')->store('personas', 'public');
            $persona->foto = $path; // Actualizar el campo 'foto' en la base de datos
        }
        // Actualiza otros campos del modelo persona
        $persona->update($request->except('foto')); // Excluimos 'foto' porque ya la procesamos
        // Sincroniza las sanciones seleccionadas
        if ($request->has('sancion_ids')) {
            $persona->sancionpersonas()->sync($request->input('sancion_ids'));
        }   // Sincroniza los tipos de persona seleccionados
        if ($request->has('tipo_persona_ids')) {
            $persona->tipoPersonas()->sync($request->input('tipo_persona_ids')); // Sincroniza los tipos de persona seleccionados
        }
        return redirect()->route('personas.index')->with('success', 'Persona actualizada con éxito');
    }
    public function __construct()
    {
        $this->middleware('can:personas.index')->only('index');
        $this->middleware('can:personas.create')->only('create', 'store');
        $this->middleware('can:personas.edit')->only('edit', 'update');
        $this->middleware('can:personas.destroy')->only('destroy');
        $this->middleware('can:personas.show')->only('show');
        // Aplicar middleware para restringir el acceso a los métodos específicos
        $this->middleware('permission:personas.imprimirPorIds')->only('imprimirPorIds');
        $this->middleware('permission:personas.imprimirTodossumarios')->only('imprimirTodossumarios');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Consulta directa a la tabla personas
                $personas = Persona::select('id as idp', 'nombre', 'apellidop', 'apellidom', 'ci', 'whatsapp', 'institucion');

                return DataTables::of($personas)
                    ->addColumn('sancion', function ($persona) {
                        return $persona->sancionpersonas->isNotEmpty() ? $persona->sancionpersonas->first()->nombre : 'No asignado'; // Cambia aquí
                    })
                    ->make(true);
                // Manejar errores de consulta a la base de datos
                //8return response()->json(['data' => $personas]); // Devolver los datos en formato JSON
            } catch (\Exception $e) {
                // Manejar errores de consulta a la base de datos
                return response()->json(['error' => 'Error al recuperar los datos de personas'], 500);
            }
        }

        return view('administrador.personas.index');
    }
    public function create()
    {

        $tipo_personas = tipo_persona::pluck('nombre', 'id');
        $sancions = sancion::pluck('nombre', 'id'); // Recupera las sanciones para la vista
        return view('administrador.personas.create', compact('tipo_personas', 'sancions'));
    }
    public function store(StorepersonaRequest $request)
    {
        // Validar los datos del request
        $request->validate([
            'nombre' => 'required|string|max:30',
            'apellidop' => 'required_with:apellidom|string|max:30',
            'apellidom' => 'required_with:apellidop|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:8048', // 8MB máximo
            'ci' => 'nullable|integer|digits_between:7,10|unique:personas,ci', // CI único, entre 7 y 10 dígitos
            'extension' => 'nullable|alpha_num|max:2', // Letras o números, máximo 2 caracteres
            'expedido' => 'nullable|string|in:LP,SC,CB,OR,PT,TJ,CH,BE,PD',  // Solo valores válidos
            'genero' => 'nullable|required|boolean', // Campo booleano, requerido (0 o 1)
            'nacionalidad' => 'nullable|string|max:30|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$/', // Solo letras, sin espacios
            'fnacimiento' => 'nullable|date', // Fecha válida
            'whatsapp' => 'nullable|string|max:15|regex:/^\d{7,15}$/', // Solo números, entre 7 y 15 caracteres
            'institucion' => 'nullable|string|max:50|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$/', // Solo letras y espacios
            'sancion_id' => 'nullable|exists:sancions,id', // El ID de sanción debe existir
            'unidad' => 'nullable|string|max:50|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$/', // Solo letras y espacios
            'cargo' => 'nullable|string|max:50|regex:/^[A-Za-záéíóúüñÁÉÍÓÚÜ\s]+$/', // Solo letras y espacios
            'domicilioreal' => 'nullable|string|max:50', // Cualquier texto
            'domiciliolegal' => 'nullable|string|max:50', // Cualquier texto
            'domicilioconvencional' => 'nullable|string|max:50', // Cualquier texto
            'gmail' => 'nullable|email|max:50', // Dirección de correo válida
           'fnacimiento' => 'nullable|date', 
            // Agrega las demás validaciones que necesites
            'tipo_persona_ids' => 'required|array|min:1', // Al menos un tipo de persona
            'tipo_persona_ids.*' => 'exists:tipo_personas,id', // Validar que los id sean válidos
            // otras validaciones para los demás campos
        ]);

        // Si se sube una foto, guárdala
        $fotoPath = null; // Inicializar la variable
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('sumarios', 'public'); // Guarda la foto en la carpeta 'sumarios' en el disco público
        }
        // Crear la nueva persona con los datos del request
        $persona = Persona::create($request->except('tipo_persona_ids')); // Excluye el campo tipo_persona_ids para manejarlo separadamente
        // Asociar los tipos de persona seleccionados a la nueva persona
        $persona->tipoPersonas()->sync($request->input('tipo_persona_ids', [])); // Sincroniza la relación muchos a muchos
        // Guardar la ruta de la foto en la base de datos si existe
        if ($fotoPath) {
            $persona->foto = $fotoPath; // Asigna la ruta de la foto
            $persona->save(); // Guarda la persona nuevamente para actualizar la ruta de la foto
        }
        return redirect('personas')->with('guardar', 'ok');
    }
    public function show(persona $persona)
    {
        // Cargar todas las relaciones de una vez
        $persona->load(['casos', 'sancionpersonas', 'tipoPersonas']);
        $casosInvolucrados = $persona->casos->count(); // Número de casos
        $sancionesPuestas = $persona->sancionpersonas->count(); // Número de sanciones
        $tiposDePersona = $persona->tipoPersonas->count(); // Número de tipos de persona
    
        // Retornar la vista con la persona y sus relaciones
        return view('administrador.personas.show', compact('persona', 'casosInvolucrados', 'sancionesPuestas', 'tiposDePersona'));
    }
    public function edit(Persona $persona)
    {
        $tipo_personas = tipo_persona::pluck('nombre', 'id');
        $sancions = sancion::pluck('nombre', 'id'); // Recupera las sanciones para la vista
        //$persona->load('sancions');// Cambié a 'sancionpersonas' // Asegúrate de cargar las sanciones
        $persona->load('sancionpersonas');
        return view('administrador.personas.edit', compact('persona', 'tipo_personas', 'sancions'));
    }
    public function destroy(persona $persona)
    {
        $persona->delete();
        return redirect('personas')->with('eliminar', 'ok');
    }
    // En tu controlador BUSQUEDA 
    ///////////////////////
    public function buscar(Request $request)
    {
        $query = $request->get('query');
        $personas = persona::where('nombre', 'LIKE', "%$query%")
            ->orWhere('ci', 'LIKE', "%$query%")
            ->get(['id', 'nombre', 'ci']); // Solo devuelve el ID, nombre y CI
    
        return response()->json($personas);
    }
}
