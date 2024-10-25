<?php

namespace App\Http\Controllers;

use App\Models\caso_actuado;
use App\Models\Actua;
use App\Models\caso;
use App\Http\Requests\Storecaso_actuadoRequest;
use App\Http\Requests\Updatecaso_actuadoRequest;
use Illuminate\Http\Request;

class CasoActuadoController extends Controller
{

    public function index()
    {
        $caso_actuados = caso_actuado::with(['caso', 'actua'])->get();
        return view('administrador.caso_actuados.index', compact('caso_actuados'));
    }
    // Método para mostrar el formulario de creación
    public function create(Request $request)
    {
        // Verificar si la petición es de AJAX para realizar la búsqueda
        if ($request->ajax()) {
            if ($request->has('caso')) {
                return $this->searchCasos($request);
            }

            if ($request->has('actua')) {
                return $this->searchActuas($request);
            }
        }

        $casos = Caso::all();
        $actuas = Actua::all();
        return view('administrador.caso_actuados.create', compact('casos', 'actuas'));
    }

    // Método para almacenar un nuevo registro
    public function store(Request $request) // Cambiado el uso de Request en lugar de Storecaso_actuadoRequest para mayor simplicidad
    {
        $validatedData = $request->validate([
            'caso_id' => 'required|array',
            'caso_id.*' => 'exists:casos,id', // Validar cada caso
            'actua_id' => 'required|array',
            'actua_id.*' => 'exists:actuas,id', // Validar cada actuado
            'fecha' => 'required|date',
        ]);

        // Bucle anidado para crear cada combinación de caso y actuado
        foreach ($validatedData['caso_id'] as $casoId) {
            foreach ($validatedData['actua_id'] as $actuaId) {
                caso_actuado::create([
                    'caso_id' => $casoId,
                    'actua_id' => $actuaId,
                    'fecha' => $validatedData['fecha'],
                ]);
            }
        }

        return redirect()->route('caso_actuados.index')->with('success', 'Casos Actuados creados exitosamente.');
    }

    // Método para mostrar un registro específico
    public function show($id)
    {       // Cargar la sanción específica junto con la persona y todas sus sanciones asociadas
        $caso_actuado = caso_actuado::with(['caso', 'actua'])->findOrFail($id); // Usando la inyección del modelo en lugar de buscar manualmente
        return view('administrador.caso_actuados.show', compact('caso_actuado'));
    }
    // Método para mostrar el formulario de edición
    public function edit(Caso_Actuado $caso_actuado)
    {
        $casos = Caso::all();
        $actuas = Actua::all();
        return view('administrador.caso_actuados.edit', compact('caso_actuado', 'casos', 'actuas'));
    }

    // Método para actualizar un registro
    public function update(Request $request, caso_actuado $caso_actuado) // Cambiado para usar Request y la inyección del modelo
    {
        $validatedData = $request->validate([
            'caso_id' => 'required|exists:casos,id',
            'actua_id' => 'required|exists:actuas,id',
            'fecha' => 'required|date',
        ]);

        $caso_actuado->update($validatedData);

        return redirect()->route('caso_actuados.index')->with('success', 'Caso Actuado actualizado exitosamente.');
    }

    // Método para eliminar un registro
    public function destroy(caso_actuado $caso_actuado)
    {
        $caso_actuado->delete();

        return redirect()->route('caso_actuados.index')->with('success', 'Caso Actuado eliminado exitosamente.');
    }
    // Método para buscar casos
    public function searchCasos(Request $request)
    {
        $query = $request->get('caso');
        // Buscar por expediente administrativo o por la identificación del caso
        $casos = Caso::where('exp_adm', 'LIKE', "%{$query}%")
                    ->orWhere('identificacion_caso', 'LIKE', "%{$query}%")
                    ->get(['id', 'exp_adm', 'identificacion_caso']);
        return response()->json($casos);
    }
    // Método para buscar actuados
    public function searchActuas(Request $request)
    {
        $query = $request->get('actua'); // Cambia 'sancion' a 'actua'
        $actuas = Actua::where('nombre', 'LIKE', "%{$query}%")->get(['id', 'nombre']);
        return response()->json($actuas);
    }
}
