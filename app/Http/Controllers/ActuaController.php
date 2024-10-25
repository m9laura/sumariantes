<?php

namespace App\Http\Controllers;

use App\Models\Actua;
use App\Http\Requests\StoreActuaRequest;
use App\Http\Requests\UpdateActuaRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables; // Importa la clase DataTables
use Illuminate\Support\Facades\Storage; // Asegúrate de incluir esta línea


class ActuaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Consulta directa a la tabla actuas
                $actuas = Actua::select('id', 'nombre', 'descripcion', 'documentos', 'fecha', 'created_at');

                return DataTables::of($actuas)
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al recuperar los datos de actas'], 500);
            }
        }
        return view('administrador.actuas.index');
    }
    public function create()
    {
        return view('administrador.actuas.create');
    }
    public function store(StoreActuaRequest $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|regex:/^[A-Za-z0-9\-\/áéíóúÁÉÍÓÚñÑ]+$/',
            'descripcion' => 'required|string', // Agregar validación mínima para prevenir vacíos
            'fecha' => 'required|date',
            'documentos' => 'nullable|file|mimes:pdf|max:4080',
        ], [
            'nombre.regex' => 'El campo nombre solo puede contener letras (incluyendo acentuadas), números, guiones y barras sin espacios.',
            'descripcion.required' => 'Complete este campo.', // Mensaje personalizado para descripción
            'documentos.required' => 'Por favor, suba un archivo PDF.',
            'documentos.mimes' => 'El archivo debe ser un documento PDF.',
            'documentos.max' => 'El archivo no debe exceder 4MB.',
        ]);

    // Limpiar la descripción de etiquetas HTML y eliminar espacios en blanco
    $descripcion = strip_tags($request->input('descripcion'));
    $descripcion = trim($descripcion); // Eliminar espacios en blanco
    $descripcion = preg_replace('/\s+/', ' ', $descripcion); // Reemplaza múltiples espacios por uno solo
   // Elimina caracteres no deseados como &nbsp;
   $descripcion= str_replace(['&nbsp;', "\u00A0"], ' ',  $descripcion); // Reemplaza &nbsp; y su representación Unicode

        // Verificar si la descripción está vacía después de limpiar
        if (empty($descripcion)) {
            return redirect()->back()->withErrors(['descripcion' => 'La descripción no puede estar vacía o contener solo espacios.'])->withInput();
        }

        // Manejo de la carga de archivos PDF
        $documentosPath = $request->file('documentos') ? $request->file('documentos')->store('documentos/soliactuas', 'public') : null;

        // Crear el registro de Actua
        Actua::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $descripcion, // Descripción limpia
            'fecha' => $request->input('fecha'),
            'documentos' => $documentosPath,
        ]);

        return redirect()->route('actuas.index')->with('success', 'El dato ha sido creado.');
    }
    public function show(Actua $actua)
    {
        return view('administrador.actuas.show', compact('actua'));
    }
    public function edit(Actua $actua)
    {
        return view('administrador.actuas.edit', compact('actua'));
    }
    public function update(Request $request, Actua $actua)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100|regex:/^[A-Za-z0-9\-\/áéíóúÁÉÍÓÚñÑ]+$/',
            'descripcion' => 'required|string', // Cambiar a 'required'
            'fecha' => 'required|date',
            'documentos' => 'nullable|file|mimes:pdf|max:4080',
        ], [
            'nombre.regex' => 'El campo nombre solo puede contener letras (incluyendo acentuadas), números, guiones y barras sin espacios.',
            'descripcion.required' => 'Complete este campo.', // Mensaje personalizado para descripción
            'documentos.required' => 'Por favor, suba un archivo PDF.',
            'documentos.mimes' => 'El archivo debe ser un documento PDF.',
            'documentos.max' => 'El archivo no debe exceder 4MB.',
        ]);
        // Limpiar la descripción de etiquetas HTML y espacios innecesarios
    $descripcionLimpia = strip_tags($request->input('descripcion')); // Elimina etiquetas HTML
    $descripcionLimpia = trim($descripcionLimpia); // Elimina espacios al principio y al final
    $descripcionLimpia = preg_replace('/\s+/', ' ', $descripcionLimpia); // Reemplaza múltiples espacios por uno solo
     // Elimina caracteres no deseados como &nbsp;
     $descripcionLimpia = str_replace(['&nbsp;', "\u00A0"], ' ', $descripcionLimpia); // Reemplaza &nbsp; y su representación Unicode

    // Actualizar los datos en la base de datos
    $actua->nombre = $request->input('nombre');
    $actua->descripcion = $descripcionLimpia; // Guardar la descripción procesada
    $actua->fecha = $request->input('fecha');
        // Manejo de la carga de archivos PDF
        if ($request->hasFile('documentos')) {
            // Eliminar el archivo anterior si existe
            if ($actua->documentos && Storage::exists('public/' . $actua->documentos)) {
                Storage::delete('public/' . $actua->documentos); // Elimina el archivo anterior
            }
            // Almacenar el nuevo archivo
            $documentosPath = $request->file('documentos')->store('documentos/soliactuas', 'public');
            $actua->documentos = $documentosPath; // Actualiza la ruta en la base de datos
        }
        // Guardar los cambios en la base de datos
        $actua->save(); // Guarda el registro actualizado
        // Redireccionar con mensaje de éxito
        return redirect()->route('actuas.index')->with('success', 'El dato ha sido actualizado.');
    }
    public function destroy($id)
    {
        try {
            // Busca el registro por ID junto con las relaciones
            $actua = Actua::with('casos')->findOrFail($id);
    
            // Verifica si hay casos relacionados
            if ($actua->casos()->count() > 0) {
                // Si hay casos relacionados, muestra un mensaje de advertencia
                return response()->json([
                    'warning' => 'No se puede eliminar el acta porque está relacionado con ' . $actua->casos()->count() . ' caso(s).'
                ], 409); // Código 409 Conflict
            }
    
            // Realiza el borrado lógico
            $actua->delete();
    
            // Devuelve una respuesta JSON en caso de éxito
            return response()->json(['success' => 'El dato ha sido eliminado.']);
        } catch (\Exception $e) {
            // Manejo de errores: devuelve un mensaje de error en caso de fallo
            return response()->json(['error' => 'Error al eliminar el dato.'], 500);
        }
    }
}
