<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $usuarios = Usuario::with('personal')->get(); // Incluir relación personal
        return response()->json($usuarios);
    }

    /**
     * Mostrar un usuario específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $usuario = Usuario::with('personal')->find($id);

        if ($usuario) {
            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'personal_fk' => 'required|exists:personal,id', // Validar existencia de personal_fk
            'nombre_usuario' => 'required|string|max:100|unique:USUARIOS',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $usuario = Usuario::create([
            'personal_fk' => $request->personal_fk,
            'nombre_usuario' => $request->nombre_usuario,
            'contrasena' => $request->contrasena,
        ]);

        return response()->json($usuario, 201);
    }



    // Login

    public function login(Request $request)
    {
        //Validacion de la solicitud
        try {
            $validatedData = $request->validate([
                'nombre_usuario' => 'required|string|max:100',
                'contrasena' => 'required|string|min:6',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }

        //Chequeo de autorizacion en la base de datos
        $usuario = Usuario::where('nombre_usuario', $validatedData['nombre_usuario'])->first();
        if (!$usuario || $validatedData["contrasena"] != $usuario["contrasena"]) {
            return response()->json(["Mensaje" => "Credenciales invalidas"], 401);
        }

        // return Usuario::where('nombre_usuario', $validatedData['nombre_usuario'])->first();

        return response()->json([
            "Usuario" => [
                "Nombre" => $usuario["nombre_usuario"],
                "contrasena" => $usuario["contrasena"],
            ],
            "token" => $usuario->createToken('auth_token')->plainTextToken,
        ], 200);
        


    }





    /**
     * Actualizar un usuario existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'personal_fk' => 'sometimes|exists:personal,id', // Validar existencia de personal_fk si se proporciona
            'nombre_usuario' => 'sometimes|string|max:100|unique:USUARIOS,nombre_usuario,' . $id,
            'contrasena' => 'sometimes|string|min:6',
        ]);

        $usuario->update(
            array_merge(
                $validatedData,
                ['contrasena' => isset($validatedData['contrasena']) ? ($validatedData['contrasena']) : $usuario->contrasena]
            )
        );

        return response()->json([
            "Nombre" => $usuario["nombre_usuario"],
            "contrasena" => $usuario["contrasena"],
        ], 200);
    }

    /**
     * Eliminar un usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            $usuario->delete();
            return response()->json(['message' => 'Usuario eliminado con éxito']);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}
