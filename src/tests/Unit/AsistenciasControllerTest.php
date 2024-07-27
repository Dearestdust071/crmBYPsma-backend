<?php

namespace Tests\Unit;

use App\Models\Asistencia;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AsistenciasControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_create_asistencia(): void   
    {
        // Crear usuarios y personal para relacionar
        $usuario = Usuario::factory()->create();
        $personal = Personal::factory()->create();

        // Definir los datos de la nueva asistencia
        $data = [
            'personal_fk' => $personal->id,
            'fecha' => now()->toDateString(),
            'presente' => true,
            'chequeo_material' => true,
            'usuario_fk' => $usuario->id,
        ];

        // Realizar una solicitud POST
        $response = $this->post('/api/asistencias', $data);

        // Verificar que la respuesta es exitosa y contiene los datos de la asistencia
        $response->assertStatus(201)
                 ->assertJson($data);

        // Verificar que la asistencia está en la base de datos
        $this->assertDatabaseHas('ASISTENCIAS', $data);
    }

    public function test_update_asistencia()
    {
        // Crear personal y usuario para relacionar
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        // Crear una asistencia existente
        $asistencia = Asistencia::factory()->create([
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
        ]);

        // Nuevos datos para actualizar
        $newPersonal = Personal::factory()->create();
        $newUsuario = Usuario::factory()->create();

        $data = [
            'personal_fk' => $newPersonal->id,
            'fecha' => now()->toDateString(),
            'presente' => false,
            'chequeo_material' => false,
            'usuario_fk' => $newUsuario->id,
        ];

        // Realizar una solicitud PUT
        $response = $this->put("/api/asistencias/{$asistencia->id}", $data);

        // Verificar que la respuesta es exitosa y contiene los datos actualizados
        $response->assertStatus(200)
                 ->assertJson($data);

        // Verificar que la asistencia ha sido actualizada en la base de datos
        $this->assertDatabaseHas('ASISTENCIAS', $data);
    }

    public function test_delete_asistencia()
    {
        // Crear personal y usuario para relacionar
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        // Crear una asistencia existente
        $asistencia = Asistencia::factory()->create([
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
        ]);

        // Realizar una solicitud DELETE
        $response = $this->delete("/api/asistencias/{$asistencia->id}");

        // Verificar que la respuesta es exitosa y contiene el mensaje de eliminación
        $response->assertStatus(200)
                 ->assertJson(['mensaje' => 'Asistencia eliminada']);

        // Verificar que la asistencia ha sido eliminada de la base de datos
        $this->assertDatabaseMissing('ASISTENCIAS', ['id' => $asistencia->id]);
    }
}
