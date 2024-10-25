<?php

namespace App\Http\Controllers;

use App\Models\caso;
use App\Http\Requests\StorecasoRequest;
use App\Http\Requests\UpdatecasoRequest;
use App\Models\persona;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\tipo_caso;
use App\Models\Actua;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // Asegúrate de incluir esta línea


class CasoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:casos.index')->only('index');
        $this->middleware('can:casos.create')->only('create', 'store');
        $this->middleware('can:casos.edit')->only('edit', 'update');
        $this->middleware('can:casos.destroy')->only('destroy');
        $this->middleware('can:casos.show')->only('show');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            try {
                // Consulta directa a la tabla personas
                $casos = caso::select('id as idc', 'exp_adm', 'registro_auxiliar', 'identificacion_caso', 'apertura_inicial', 'resolucion_final',);

                //8return response()->json(['data' => $personas]); // Devolver los datos en formato JSON
                return DataTables::of($casos)->make(true);
            } catch (\Exception $e) {
                // Manejar errores de consulta a la base de datos
                return response()->json(['error' => 'Error al recuperar los datos de casos'], 500);
            }
        }

        return view('administrador.casos.index');
    }

    public function create()
    {

        return view('administrador.casos.create');
    }
    public function store(StorecasoRequest $request)
    {
        // Verificar si el 'registro_auxiliar' ya existe en la base de datos
        $registroAuxiliar = $request->input('registro_auxiliar');

        if (Caso::where('registro_auxiliar', $registroAuxiliar)->exists()) {
            // Si el registro auxiliar ya existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['registro_auxiliar' => 'El registro auxiliar ya existe en la base de datos.'])->withInput();
        }
        // 1. Validar los campos
        $request->validate(
            [
                'exp_adm' => 'required|string|max:10|regex:/^[A-Za-z0-9-\/]*$/', //permite letras, números, guion '-' y barra '/'
                'registro_auxiliar' => 'nullable|string|max:10|regex:/^[A-Za-z0-9-\/]*$/|unique:casos,registro_auxiliar', // Permitir letras, números, guion '-' y barra '/', debe ser único
                'ejecutoria' => 'required|date', // Asegura que sea una fecha válida
                'identificacion_caso' => 'required|string',  // Permite texto largo sin límite de caracteres
                'apertura_inicial' => 'nullable|string',  // Permite texto largo sin límite de caracteres
                //  ///pdf,fotos etc
                // 'registro_aux' => 'nullable|file|mimes:pdf',// Archivo PDF
                // 'mae' => 'nullable|file|mimes:pdf', // Archivo PDF
                //   ///
                'instructivo' => 'nullable|string',
                'apertura_inicial' => 'nullable|string',
                'tipo_caso_id' => 'nullable|exists:tipo_casos,id',
                'resolucion_final' => 'nullable|string',
                'recurso_revocatoria' => 'nullable|string',
                'recurso_jerarquico' => 'nullable|string',
                'ejecutoria' => 'nullable|date',
                'antecedentes' => 'nullable|string',
                'estapa' => 'nullable|string|max:50',
                'estado_proceso' => 'nullable|string|max:50',
                'fecha' => 'nullable|date',
            ],
            [
                'registro_auxiliar.unique' => 'El registro auxiliar ya existe en la base de datos.',
                'registro_auxiliar.regex' => 'El registro auxiliar solo puede contener letras, números, guiones (-) y barras (/).',
            ]
        );
        $maePath = null;
        $registro_auxPath = null;
        // Manejo de la carga de archivos PDF
        if ($request->hasFile('mae')) {
            // Almacenar el archivo en la carpeta storage/app/public/documentos/maes
            $maePath = $request->file('mae')->store('documentos/maes', 'public');
        }
        if ($request->hasFile('registro_aux')) {
            // Almacenar el archivo en la carpeta storage/app/public/documentos/hoja_rutas
            $registro_auxPath = $request->file('registro_aux')->store('documentos/registro_aux', 'public');
        }
        // Limpiar los campos que pueden contener HTML
        $identificacionCaso = strip_tags($request->input('identificacion_caso'), '<b><i><u>'); // Permitir solo ciertas etiquetas HTML
        $aperturaInicial = strip_tags($request->input('apertura_inicial'), '<b><i><u>');
        $resolucionFinal = strip_tags($request->input('resolucion_final'), '<b><i><u>');
        $recursoRevocatoria = strip_tags($request->input('recurso_revocatoria'), '<b><i><u>');
        $recursoJerarquico = strip_tags($request->input('recurso_jerarquico'), '<b><i><u>');
        $antecedentes = strip_tags($request->input('antecedentes'), '<b><i><u>');
        $instructivo = strip_tags($request->input('instructivo'), '<b><i><u>');
        // 2. Crear el caso y almacenar las rutas de los archivos
        // Crear el caso
        $caso = Caso::create([
            'exp_adm' => $request->input('exp_adm'),
            'registro_auxiliar' => $request->input('registro_auxiliar'),
            'identificacion_caso' => $identificacionCaso,  // Guardar contenido limpio
            'mae' => $maePath,
            'apertura_inicial' => $aperturaInicial,  // Guardar contenido limpio
            'tipo_caso_id' => $request->input('tipo_caso_id'),
            'resolucion_final' => $resolucionFinal,  // Guardar contenido limpio
            'registro_aux' => $registro_auxPath,
            'recurso_revocatoria' => $recursoRevocatoria,  // Guardar contenido limpio
            'recurso_jerarquico' => $recursoJerarquico,  // Guardar contenido limpio
            'ejecutoria' => $request->input('ejecutoria'),
            'antecedentes' => $antecedentes,  // Guardar contenido limpio
            'estapa' => $request->input('estapa'),
            'estado_proceso' => $request->input('estado_proceso'),
            'fecha' => $request->input('fecha'),
        ]);
        // 3. Manejo de la asociación de personas
        $personasData = json_decode($request->input('personas'), true); // Asumimos que las personas se envían en formato JSON
        // Verifica si $personasData no es null y es un array válido
        if (!empty($personasData) && is_array($personasData)) {
            foreach ($personasData as $personaData) {
                $persona = Persona::where('ci', $personaData['ci'])->first();
                // Si la persona no existe, la creamos
                if (!$persona) {
                    $persona = Persona::create($personaData);
                }
                // Asociar la persona al caso
                $caso->personas()->attach($persona->id);
            }
        } else {
            // Mostrar mensaje de error si no se enviaron personas
            return redirect()->back()->with('error', 'Debe asociar al menos una persona al caso.');
        }
        // Asociar la persona al caso
        return redirect('casos')->with('guardar', 'ok');
    }

    public function show($id)
    {
        // Buscar el caso por su ID junto con relaciones
        $caso = Caso::with(['tipoCaso', 'personas', 'actuas'])->findOrFail($id);
        // Devolver la vista con los datos del caso
        return view('administrador.casos.show', compact('caso'));
    }

    public function edit($id)
    {
        $caso = Caso::with(['personas', 'actuas'])->findOrFail($id);

        // Asegúrate de que ejecutoria y fecha sean objetos Carbon
        if ($caso->ejecutoria) {
            $caso->ejecutoria = Carbon::parse($caso->ejecutoria);
        }
        if ($caso->fecha) {
            $caso->fecha = Carbon::parse($caso->fecha);
        }
    
        // Limpiar el contenido de los campos que pueden contener HTML
        $caso->identificacion_caso = strip_tags($caso->identificacion_caso, '<b><i><u>'); // Permitir solo ciertas etiquetas HTML
        $caso->apertura_inicial = strip_tags($caso->apertura_inicial, '<b><i><u>');
        $caso->resolucion_final = strip_tags($caso->resolucion_final, '<b><i><u>');
        $caso->recurso_revocatoria = strip_tags($caso->recurso_revocatoria, '<b><i><u>');
        $caso->recurso_jerarquico = strip_tags($caso->recurso_jerarquico, '<b><i><u>');
        $caso->antecedentes = strip_tags($caso->antecedentes, '<b><i><u>');
        $caso->instructivo = strip_tags($caso->instructivo, '<b><i><u>');
    
        $tiposCaso = Tipo_Caso::all(); // Obtener todos los tipos de caso
        $personas = Persona::all(); // Obtener todas las personas
        $actuas = Actua::all(); // Obtener todas las actuadas
    
        return view('administrador.casos.edit', compact('caso', 'tiposCaso', 'personas', 'actuas'));
    }

    public function update(UpdatecasoRequest $request, caso $caso)
    {
        // Actualizar los campos del caso
        $caso->update([
            'exp_adm' => $request->input('exp_adm'),
            'registro_auxiliar' => $request->input('registro_auxiliar'),
            'identificacion_caso' => $request->input('identificacion_caso'),
            'apertura_inicial' => $request->input('apertura_inicial'),
            'tipo_caso_id' => $request->input('tipo_caso_id'),
            'resolucion_final' => $request->input('resolucion_final'),
            'recurso_revocatoria' => $request->input('recurso_revocatoria'),
            'recurso_jerarquico' => $request->input('recurso_jerarquico'),
            'ejecutoria' => $request->input('ejecutoria'),
            'antecedentes' => $request->input('antecedentes'),
            'estado_proceso' => $request->input('estado_proceso'),
            'fecha' => $request->input('fecha'),
        ]);
        // Manejo de la carga de archivos
        if ($request->hasFile('mae')) {
            // Eliminar el archivo anterior si existe
            if ($caso->mae && Storage::exists('public/' . $caso->mae)) {
                Storage::delete('public/' . $caso->mae);
            }
            // Almacenar el nuevo archivo
            $maePath = $request->file('mae')->store('documentos/maes', 'public');
            $caso->mae = $maePath; // Asigna directamente
        }
        if ($request->hasFile('registro_aux')) {
            // Eliminar el archivo anterior si existe
            if ($caso->registro_aux && Storage::exists('public/' . $caso->registro_aux)) {
                Storage::delete('public/' . $caso->registro_aux);
            }
            // Almacenar el nuevo archivo
            $registro_auxPath = $request->file('registro_aux')->store('documentos/registro_aux', 'public');
            $caso->registro_aux = $registro_auxPath; // Asigna directamente
        }
        $caso->save(); // Guardar los cambios en la base de datos
        // Actualizar la asociación de personas
        $personasIds = $request->input('personas_ids', []); // Asegúrate que coincida con el nombre en el formulario
        $caso->personas()->sync($personasIds);
        $actuasData = [];  // Array para almacenar actuados con sus fechas
        foreach ($request->input('actuas_ids', []) as $actuaId) {
            $actuasData[$actuaId] = ['fecha' => now()];  // Puedes cambiar now() por una fecha específica si la obtienes del formulario
        }
        $caso->actuas()->sync($actuasData);  // Sincronizar actuados con la tabla pivote
        return redirect('casos')->with('editar', 'ok');
    }

    public function destroy(caso $caso)
    {
        $caso->delete();
        return redirect('casos')->with('eliminar', 'ok');
    }

    public function buscarPorCI($ci)
    {
        $persona = persona::where('ci', $ci)->first();

        if ($persona) {
            return response()->json(['existe' => true, 'persona' => $persona]);
        } else {
            return response()->json(['existe' => false]);
        }
    }
}
