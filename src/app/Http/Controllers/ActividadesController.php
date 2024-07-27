<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class ActividadesController extends Controller
{
    public function index()
    {
        $actividades = Actividad::all();
        return response()->json($actividades);
    }

    public function show($id)
    {
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['mensaje' => 'Actividad no encontrada'], 404);
        }
        return response()->json($actividad);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'usuario_fk' => 'required|exists:usuarios,id',  // Actualizado
            'personal_fk' => 'required|exists:personal,id',  // Actualizado
        ]);

        $actividad = Actividad::create($request->all());
        return response()->json($actividad, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'usuario_fk' => 'required|exists:usuarios,id',  // Actualizado
            'personal_fk' => 'required|exists:personal,id',  // Actualizado
        ]);

        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['mensaje' => 'Actividad no encontrada'], 404);
        }
        $actividad->update($request->all());
        return response()->json($actividad);
    }

    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['mensaje' => 'Actividad no encontrada'], 404);
        }
        $actividad->delete();
        return response()->json(['mensaje' => 'Actividad eliminada']);
    }
}
