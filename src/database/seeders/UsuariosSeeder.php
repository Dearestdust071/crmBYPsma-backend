<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;
class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 registros de usuarios usando la factory
        $usuarios = Usuario::factory()->count(10)->create();

        // Para cada registro de usuario, asociar roles
        $usuarios->each(function ($usuario) {
            // Asociar un rol al usuario en la tabla pivote ROLES_USUARIOS
            $usuario->roles()->attach(Rol::inRandomOrder()->first());
        });
    }
}
