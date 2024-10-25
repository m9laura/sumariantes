<?php

namespace App\Http\Controllers;

use App\Models\tipo_caso;
use App\Models\caso;
use App\Http\Requests\Storetipo_casoRequest;
use App\Http\Requests\Updatetipo_casoRequest;
use Illuminate\Http\Request;

class TipoCasoController extends Controller
{
    // Descomenta esto si tienes las políticas de autorización configuradas
    // public function __construct()
    // {
    //     $this->middleware('can:tipo_casos.index')->only('index');
    //     $this->middleware('can:tipo_casos.create')->only('create', 'store');
    //     $this->middleware('can:tipo_casos.edit')->only('edit', 'update');
    //     $this->middleware('can:tipo_casos.destroy')->only('destroy');
    // }

    // Método para mostrar la lista de tipos de casos
    public function index()
    {
        $tipo_casos = tipo_caso::all(); // Obtener todos los tipos de casos
        return view('administrador.tipo_casos.index', compact('tipo_casos')); // Asegúrate de crear esta vista
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('administrador.tipo_casos.create'); // Asegúrate de crear esta vista
    }

    // Método para almacenar un nuevo tipo de caso
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
            'descripcion' => 'required|string',
            'estado' => 'boolean',
            'gravedad' => 'required|integer',
        ]);

        tipo_caso::create($request->all()); // Crear un nuevo tipo de caso

        return redirect()->route('tipo_casos.index')->with('guardar', 'ok');
    }

    // Método para mostrar un tipo de caso específico
    public function show(tipo_caso $tipoCaso)
    {
        $casos = $tipoCaso->casos; // Obtener los casos relacionados
        return view('administrador.tipo_casos.show', compact('tipoCaso', 'casos')); // Asegúrate de crear esta vista
    }

// Método para editar un tipo de caso
public function edit($id)
{
    // Encuentra el tipo de caso por su ID
    $tipoCaso = tipo_caso::findOrFail($id);

    // Devuelve la vista de edición con el tipo de caso
    return view('administrador.tipo_casos.edit', compact('tipoCaso')); // Asegúrate de crear esta vista
}
    // Método para actualizar un tipo de caso
       // Método para actualizar un tipo de caso
       public function update(Request $request, $id)
    {
            // Valida los datos recibidos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'estado' => 'required|boolean',
                'gravedad' => 'required|integer',
            ]);
    
            // Encuentra el tipo de caso por su ID y actualiza los campos
            $tipoCaso = tipo_caso::findOrFail($id);
            $tipoCaso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado,
                'gravedad' => $request->gravedad,
            ]);
    
            // Redirige a la lista de tipos de casos con un mensaje de éxito
            return redirect()->route('tipo_casos.index')->with('success', 'Tipo de caso actualizado con éxito.');
        }
    

    // Método para eliminar un tipo de caso
    public function destroy(tipo_caso $tipoCaso)
    {
        $tipoCaso->delete(); // Eliminar el tipo de caso
        return redirect()->route('tipo_casos.index')->with('eliminar', 'ok');
    }
}
