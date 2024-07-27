<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class SancionesController extends Controller
{
    public function index()
    {
        $sanciones = Sancion::all();
        return response()->json($sanciones);
    }

    public function show($id)
    {
        $sancion = Sancion::find($id);
        if (!$sancion) {
            return response()->json(['mensaje' => 'Sancion no encontrada'], 404);
        }
        return response()->json($sancion);
    }

    public function store(Request $request)
    {

        try {
            $request->validate(
                [
                    'personal_fk' => 'required|exists:personal,id',
                    'usuario_fk' => 'required|exists:usuarios,id',
                    'fecha' => 'required|date',
                    'motivo' => 'required|string|max:200',
                ]
            );
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->errors()], 422);
        }

        $sancion = Sancion::create([
            'personal_fk' => $request->personal_fk, // Asegúrate de que este valor existe en la tabla PERSONAL
            'usuario_fk' => $request->usuario_fk,   // Asegúrate de que este valor existe en la tabla USUARIOS
            'fecha' => now(),
            'motivo' => 'Sancion por falta de equipamiento',
        ]);

        return response()->json([
            'Informacion' => $sancion,
        ], 201);
    }





    public function update(Request $request, $id)
    {

        try {
            $request->validate(
                [
                    'personal_fk' => 'required|exists:personal,id',
                    'usuario_fk' => 'required|exists:usuarios,id',
                    'fecha' => 'required|date',
                    'motivo' => 'required|string|max:200',
                ]
            );
        } catch (ValidationException $e) {
            return response()->json(['mensaje' => $e->errors()], 422);
        }
        
        $sancion = Sancion::find($id);
        if (!$sancion) {
            return response()->json(['mensaje' => 'Sancion no encontrada'], 404);
        }
        $sancion->update($request->all());
        return response()->json($sancion, 200);
    }

    public function destroy($id)
    {
        $sancion = Sancion::find($id);
        if (!$sancion) {
            return response()->json(['mensaje' => 'Sancion no encontrada'], 404);
        }
        $sancion->delete();
        return response()->json(['mensaje' => 'Sancion eliminada']);
    }
}
