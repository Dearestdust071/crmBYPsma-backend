<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;

class AsistenciasController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::all();
        return response()->json($asistencias);
    }

    public function show($id)
    {
        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return response()->json(['mensaje' => 'Asistencia no encontrada'], 404);
        }
        return response()->json($asistencia);
    }

    public function store(Request $request)
    {
        $request->validate([
            'personal_fk' => 'required|exists:personal,id',
            'fecha' => 'required|date',
            'presente' => 'required|boolean',
            'chequeo_material' => 'required|boolean',
            'usuario_fk' => 'required|exists:usuarios,id',
        ]);

        $asistencia = Asistencia::create($request->all());
        return response()->json($asistencia, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'personal_fk' => 'required|exists:personal,id',
            'fecha' => 'required|date',
            'presente' => 'required|boolean',
            'chequeo_material' => 'required|boolean',
            'usuario_fk' => 'required|exists:usuarios,id',
        ]);

        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return response()->json(['mensaje' => 'Asistencia no encontrada'], 404);
        }
        $asistencia->update($request->all());
        return response()->json($asistencia);
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return response()->json(['mensaje' => 'Asistencia no encontrada'], 404);
        }
        $asistencia->delete();
        return response()->json(['mensaje' => 'Asistencia eliminada']);
    }
}
