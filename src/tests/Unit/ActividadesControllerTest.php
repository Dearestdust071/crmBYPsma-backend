<?php

namespace Tests\Unit;

use App\Models\Actividad;
use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ActividadesControllerTest extends TestCase
{
   

    use RefreshDatabase, WithoutMiddleware;

    public function test_update_actividad()
{
    // Crear usuarios y personal para relacionar
    $usuario = Usuario::factory()->create();
    $personal = Personal::factory()->create();

    // Crear una actividad existente
    $actividad = Actividad::factory()->create([
        'usuario_fk' => $usuario->id,
        'personal_fk' => $personal->id,
    ]);

    // Nuevos datos para actualizar
    $newUsuario = Usuario::factory()->create();
    $newPersonal = Personal::factory()->create();

    $data = [
        'titulo' => 'Actividad Actualizada',
        'descripcion' => 'Descripción actualizada',
        'fecha' => now()->toDateString(),
        'usuario_fk' => $newUsuario->id,
        'personal_fk' => $newPersonal->id,
    ];

    // Realizar una solicitud PUT
    $response = $this->put("/api/actividades/{$actividad->id}", $data);

    // Verificar que la respuesta es exitosa y contiene los datos actualizados
    $response->assertStatus(200)
             ->assertJson($data);

    // Verificar que la actividad ha sido actualizada en la base de datos
    $this->assertDatabaseHas('ACTIVIDADES', $data);
}



public function test_delete_actividad()
{
    // Crear usuarios y personal para relacionar
    $usuario = Usuario::factory()->create();
    $personal = Personal::factory()->create();

    // Crear una actividad existente
    $actividad = Actividad::factory()->create([
        'usuario_fk' => $usuario->id,
        'personal_fk' => $personal->id,
    ]);

    // Realizar una solicitud DELETE
    $response = $this->delete("/api/actividades/{$actividad->id}");

    // Verificar que la respuesta es exitosa y contiene el mensaje de eliminación
    $response->assertStatus(200)
             ->assertJson(['mensaje' => 'Actividad eliminada']);

    // Verificar que la actividad ha sido eliminada de la base de datos
    $this->assertDatabaseMissing('ACTIVIDADES', ['id' => $actividad->id]);
}

}
