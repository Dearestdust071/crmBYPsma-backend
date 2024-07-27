<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Sancion;
use App\Models\Usuario;
use App\Models\Personal;

class SancionesControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_creates_sancion()
    {
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        $response = $this->post('/api/sanciones', [
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
            'fecha' => '2024-07-26',
            'motivo' => 'Test Sancion',
        ]);

        $response->assertStatus(201);
    }

    public function test_updates_sancion()
    {
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        $sancion = Sancion::create([
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
            'fecha' => '2024-07-26',
            'motivo' => 'Test Sancion',
        ]);

        $response = $this->put("/api/sanciones/{$sancion->id}", [
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
            'fecha' => '2024-07-26', // Si es necesario
            'motivo' => 'Updated Sancion',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('SANCIONES', [
            'motivo' => 'Updated Sancion',
        ]);
    }

    public function test_deletes_sancion()
    {
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        $sancion = Sancion::create([
            'personal_fk' => $personal->id,
            'usuario_fk' => $usuario->id,
            'fecha' => '2024-07-26',
            'motivo' => 'Test Sancion',
        ]);

        $response = $this->delete("/api/sanciones/{$sancion->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('SANCIONES', [
            'id' => $sancion->id,
        ]);
    }
}
