<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Personal;

class UsuariosControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_register_usuario()
    {
        $personal = Personal::factory()->create();

        $response = $this->post('/api/register', [
            'personal_fk' => $personal->id,
            'nombre_usuario' => 'TestUsuario',
            'contrasena' => 'password',
            'contrasena_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('USUARIOS', [
            'nombre_usuario' => 'TestUsuario',
        ]);
    }

    public function test_login_usuario()
    {
        $personal = Personal::factory()->create();

        $usuario = Usuario::factory()->create([
            'personal_fk' => $personal->id,
            'nombre_usuario' => 'TestUsuario',
            'contrasena' => 'password',
        ]);

        $response = $this->post('/api/login', [
            'nombre_usuario' => 'TestUsuario',
            'contrasena' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'Usuario' => [
                'Nombre',
                'contrasena',
            ],
            'token',
        ]);
    }

    public function test_update_usuario()
    {
        $personal = Personal::factory()->create();

        $usuario = Usuario::factory()->create([
            'personal_fk' => $personal->id,
            'nombre_usuario' => 'OldNombreUsuario',
            'contrasena' => 'password',
        ]);

        $response = $this->put("/api/usuarios/{$usuario->id}", [
            'nombre_usuario' => 'UpdatedNombreUsuario',
            'contrasena' => 'newpassword',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('USUARIOS', [
            'nombre_usuario' => 'UpdatedNombreUsuario',
        ]);
    }

    public function test_delete_usuario()
    {
        $personal = Personal::factory()->create();

        $usuario = Usuario::factory()->create([
            'personal_fk' => $personal->id,
            'nombre_usuario' => 'TestUsuario',
            'contrasena' => 'password',
        ]);

        $response = $this->delete("/api/usuarios/{$usuario->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('USUARIOS', [
            'id' => $usuario->id,
        ]);
    }
}
