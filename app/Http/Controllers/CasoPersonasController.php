<?php

namespace App\Http\Controllers;

use App\Models\caso_personas;
use App\Models\caso;
use App\Models\persona;
use App\Http\Requests\Storecaso_personasRequest;
use App\Http\Requests\Updatecaso_personasRequest;
use Illuminate\Http\Request;
class CasoPersonasController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de caso_personas junto con los casos y personas relacionados
    $casoPersonas = caso_personas::with(['caso', 'persona'])->get();
    return view('administrador.caso_personas.index', compact('casoPersonas'));
    }

    public function create()
    {
        $casos = Caso::all();
        $personas = Persona::all();
        return view('administrador.caso_personas.create', compact('casos', 'personas'));
    }

    public function store(Storecaso_personasRequest $request) // Corrige el nombre aquí
    {
        $request->validate([
            'caso_id' => 'required|exists:casos,id',
            'persona_id' => 'required|exists:personas,id',
           // 'fecha' => 'required|date',
        ]);

        Caso::find($request->caso_id)->personas()->attach($request->persona_id, ['fecha' => $request->fecha]);

        return redirect()->route('caso_personas.index')->with('success', 'Persona agregada al caso.');
    }

    public function show($id) // Cambié el parámetro a $id
    {
      // Obtener el caso junto con las personas relacionadas y la fecha de la relación
      $casoPersona = Caso::with(['personas' => function ($query) {
        $query->withPivot('fecha'); // Incluye la fecha de la tabla pivote
    }])->findOrFail($id);

    // Convertir la fecha a Carbon si no lo está
    if ($casoPersona->fecha) {
        $casoPersona->fecha = \Carbon\Carbon::parse($casoPersona->fecha);
    }
    return view('administrador.caso_personas.show', compact('casoPersona'));
}

    public function edit($id) // Cambié el parámetro a $id
    {
        $casoPersona = Caso::with('personas')->findOrFail($id); // Carga el caso junto con las personas
        $casos = Caso::all();
        $personas = Persona::all();
        return view('administrador.caso_personas.edit', compact('casoPersona', 'casos', 'personas'));
    }

    public function update(Updatecaso_personasRequest $request, $id) // Cambié el parámetro a $id
    {
        $request->validate([
            'caso_id' => 'required|exists:casos,id',
            'persona_id' => 'required|exists:personas,id',
           // 'fecha' => 'required|date',
        ]);

        // Actualiza el registro en la tabla pivote
        Caso::find($request->caso_id)->personas()->updateExistingPivot($request->persona_id, ['fecha' => $request->fecha]);

        return redirect()->route('caso_personas.index')->with('success', 'Datos actualizados.');
    }

    public function destroy($id) // Cambié el parámetro a $id
    {
        // Aquí debes implementar la lógica para eliminar el registro de la tabla pivote
        $casoPersona = Caso::findOrFail($id);
        // Por ejemplo, puedes eliminar la relación especificando el ID de la persona que deseas eliminar
        $casoPersona->personas()->detach($id); // Asegúrate de especificar el ID correcto de la persona
        return redirect()->route('caso_personas.index')->with('success', 'Registro eliminado.');
    }
    // Nueva función para buscar personas por CI o nombre
    public function searchPersonas(Request $request)
    {
        $query = $request->get('persona');

        // Busca las personas que coincidan con el CI o el nombre
        $personas = Persona::where('ci', 'LIKE', '%' . $query . '%')
                            ->orWhere('nombre', 'LIKE', '%' . $query . '%')
                            ->get();

        // Retorna los resultados en formato JSON
        return response()->json($personas);
    }

    // Nueva función para buscar casos por nombre
    public function searchCasos(Request $request)
    {
       // Recibir el término de búsqueda
    $search = $request->input('caso');
    // Busca casos cuyo exp_adm o registro_auxiliar coincida parcialmente con el término ingresado
    $casos = Caso::where('exp_adm', 'LIKE', '%' . $search . '%')
                 ->orWhere('registro_auxiliar', 'LIKE', '%' . $search . '%')
                 ->get();
    // Devuelve los casos como respuesta JSON
    return response()->json($casos);
}
}

