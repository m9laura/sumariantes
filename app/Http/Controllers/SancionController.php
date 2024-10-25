<?php

namespace App\Http\Controllers;
use App\Models\sancion;
use App\Http\Requests\StoresancionRequest;
use App\Http\Requests\UpdatesancionRequest;
use Yajra\DataTables\DataTables; // Importa la clase DataTables
use Illuminate\Http\Request;
use App\Models\persona;
use Illuminate\Support\Facades\Log;


class SancionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $sanciones = Sancion::select('id', 'nombre', 'descripcion', 'estado', 'fecha', 'created_at');
                return DataTables::of($sanciones)->make(true);
            } catch (\Exception $e) {
                Log::error('Error al recuperar los datos de sanciones: ' . $e->getMessage());
                return response()->json(['error' => 'Error al recuperar los datos de sanciones'], 500);
            }
        }
    
        return view('administrador.sancions.index');
    }

    public function create()
    {
        return view('administrador.sancions.create');
    }

    public function store(StoresancionRequest $request)
    {    // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
            'fecha' => 'required|date',
        ]);

        // Crear la nueva sanción
        Sancion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado, // Asegúrate de que este valor se esté guardando
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('sancions.index')->with('guardar', 'ok');
    }
    public function show(sancion $sancion)
    {
        return view('administrador.sancions.show', compact('sancion'));
    }

    public function edit(sancion $sancion)
    {
        return view('administrador.sancions.edit', compact('sancion'));
    }

    public function update(UpdatesancionRequest $request, sancion $sancion)
    {
        $sancion->update($request->all());
        $sancion->save();
        return  redirect('sancions')->with('editar', 'ok'); //redirecciona a la vista principal
    }

    public function destroy(sancion $sancion)
    {
        $sancion->delete();
        return redirect()->route('sancions')->with('eliminar', 'ok');
    }
    public function buscar(Request $request)
    {
        $query = $request->get('query');
        $personas = persona::where('nombre', 'LIKE', "%$query%")
            ->orWhere('ci', 'LIKE', "%$query%")
            ->get(['id', 'nombre', 'ci']); // Solo devuelve el ID, nombre y CI

        return response()->json($personas);
    }
}
