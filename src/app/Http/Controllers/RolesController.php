<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    public function show($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }
        return response()->json($rol);
    }

    public function store(Request $request)
    {
        

        $rol = Rol::create($request->all());
        return response()->json($rol, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rol_nombre' => 'required|string|max:50',
        ]);

        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }
        $rol->update($request->all());
        return response()->json($rol);
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }
        $rol->delete();
        return response()->json(['mensaje' => 'Rol eliminado']);
    }
}
