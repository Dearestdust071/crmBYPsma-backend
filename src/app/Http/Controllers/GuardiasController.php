<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardia;

class GuardiasController extends Controller
{
    public function index()
    {
        $guardias = Guardia::all();
        return response()->json($guardias);
    }

    public function show($id)
    {
        $guardia = Guardia::find($id);
        if (!$guardia) {
            return response()->json(['mensaje' => 'Guardia no encontrada'], 404);
        }
        return response()->json($guardia);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia_semana' => 'required|string|max:100',
        ]);

        $guardia = Guardia::create($request->all());
        return response()->json($guardia, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dia_semana' => 'required|string|max:100',
        ]);

        $guardia = Guardia::find($id);
        if (!$guardia) {
            return response()->json(['mensaje' => 'Guardia no encontrada'], 404);
        }
        $guardia->update($request->all());
        return response()->json($guardia);
    }

    public function destroy($id)
    {
        $guardia = Guardia::find($id);
        if (!$guardia) {
            return response()->json(['mensaje' => 'Guardia no encontrada'], 404);
        }
        $guardia->delete();
        return response()->json(['mensaje' => 'Guardia eliminada']);
    }
}
