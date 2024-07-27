<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PersonalController extends Controller
{
    // Método para listar todos los registros de personal
    public function index()
    {
        $personal = Personal::all();
        return response()->json($personal, 200);
    }

    // Método para mostrar un registro de personal específico
    public function show($id)
    {
        $personal = Personal::find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado.'], 404);
        }

        return response()->json($personal, 200);
    }

    // Método para crear un nuevo registro de personal
    public function store(Request $request)
    {
        try {
            // Validación de los datos de entrada
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
                'numero_telefono' => 'required|string|max:15',
            ]);

            // Creación del nuevo registro de personal
            $personal = Personal::create($validated);

            // Respuesta exitosa con código 201 (Creado)
            return response()->json($personal, 201);
        } catch (\Exception $e) {
            // Manejo genérico de excepciones
            return response()->json(['message' => 'Error al crear el personal.'], 500);
        }
    }

    // Método para actualizar un registro de personal específico
    public function update(Request $request, $id)
    {
        $personal = Personal::find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado.'], 404);
        }

        try {
            // Validación de los datos de entrada
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
                'numero_telefono' => 'required|string|max:15',
            ]);

            // Actualización del registro de personal
            $personal->update($validated);

            // Respuesta exitosa con código 200 (OK)
            return response()->json($personal, 200);
        } catch (ValidationException $e) {
            // Manejo de excepciones de validación
            return response()->json($e->errors(), 400);
        } catch (\Exception $e) {
            // Manejo genérico de excepciones
            return response()->json(['message' => 'Error al actualizar el personal.'], 500);
        }
    }

    // Método para eliminar un registro de personal específico
    public function destroy($id)
    {
        $personal = Personal::find($id);

        if (!$personal) {
            return response()->json(['message' => 'Personal no encontrado.'], 404);
        }

        // Eliminación del registro de personal
        $personal->delete();

        // Respuesta exitosa con código 200 (OK)
        return response()->json(['message' => 'Personal eliminado exitosamente.'], 200);
    }
}
