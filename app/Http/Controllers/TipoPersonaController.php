<?php

namespace App\Http\Controllers;

use App\Models\tipo_persona;
use App\Http\Requests\Storetipo_personaRequest;
use App\Http\Requests\Updatetipo_personaRequest;

class TipoPersonaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:tipo_personas.index')->only('index');
        $this->middleware('can:tipo_personas.create')->only('create', 'store');
        $this->middleware('can:tipo_personas.edit')->only('edit', 'update');
        $this->middleware('can:tipo_personas.destroy')->only('destroy');
    }

    public function index()
    {
        $tipo_personas = tipo_persona::all();
        return view('administrador.tipo_personas.index', compact('tipo_personas'));
    }


    public function create()
    {
        return view('administrador.tipo_personas.create');
    }

    public function store(Storetipo_personaRequest $request)
    {
        // Crea un nuevo tipo de persona y lo guarda en la base de datos
        tipo_persona::create($request->validated()); // Usa 'validated()' para obtener solo los datos válidos
        return redirect('tipo_personas')->with('guardar', 'ok');
    }
    public function show(tipo_persona $tipo_persona)
    {
        return view('administrador.tipo_personas.show', compact('tipo_persona'));
    }

    public function edit(tipo_persona $tipo_persona)
    {
        return view('administrador.tipo_personas.edit', compact('tipo_persona'));
    }


    public function update(Updatetipo_personaRequest $request, tipo_persona $tipo_persona)
    {
        $tipo_persona->update($request->validated());
        
        return  redirect('tipo_personas')->with('editar', 'ok'); //redirecciona a la vista principal
    }


    public function destroy(tipo_persona $tipo_persona)
    {
        $tipo_persona->delete();
        return redirect('tipo_personas')->with('eliminar', 'ok');
    }
}
