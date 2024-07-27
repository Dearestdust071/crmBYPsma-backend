<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;

class TurnosController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();
        return response()->json($turnos);
    }

    public function show($id)
    {
        $turno = Turno::find($id);
        if (!$turno) {
            return response()->json(['mensaje' => 'Turno no encontrado'], 404);
        }
        return response()->json($turno);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
        ]);

        $turno = Turno::create($request->all());
        return response()->json($turno, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
        ]);

        $turno = Turno::find($id);
        if (!$turno) {
            return response()->json(['mensaje' => 'Turno no encontrado'], 404);
        }
        $turno->update($request->all());
        return response()->json($turno);
    }

    public function destroy($id)
    {
        $turno = Turno::find($id);
        if (!$turno) {
            return response()->json(['mensaje' => 'Turno no encontrado'], 404);
        }
        $turno->delete();
        return response()->json(['mensaje' => 'Turno eliminado']);
    }
}
