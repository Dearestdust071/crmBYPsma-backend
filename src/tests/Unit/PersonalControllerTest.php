<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Personal;

class PersonalControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_creates_personal()
    {
        $response = $this->post('/api/personal', [
            'nombre' => 'Test Personal',
            'apellido_paterno' => 'test apellido paterno',
            'apellido_materno' => 'test apellido materno',
            'numero_telefono'=> '1231231231',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('PERSONAL', [
            'nombre' => 'Test Personal',
            'apellido_paterno' => 'test apellido paterno',
            'apellido_materno' => 'test apellido materno',
            'numero_telefono'=> '1231231231',
        ]);
    }

    public function test_updates_personal()
    {
        $personal = Personal::factory()->create([
            'nombre' => 'Old Nombre',
            'apellido_paterno' => 'test apellido paterno',
            'apellido_materno' => 'test apellido materno',
            'numero_telefono'=> '1231231231',
        ]);

        $response = $this->put("/api/personal/{$personal->id}", [
            'nombre' => 'Updated Nombre',
            'apellido_paterno' => 'new apellido paterno',
            'apellido_materno' => 'new apellido materno',
            'numero_telefono'=> '1231231231',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('PERSONAL', [
            'nombre' => 'Updated Nombre',
            'apellido_paterno' => 'new apellido paterno',
            'apellido_materno' => 'new apellido materno',
            'numero_telefono'=> '1231231231',
        ]);
    }

    public function test_deletes_personal()
    {
        $personal = Personal::factory()->create();

        $response = $this->delete("/api/personal/{$personal->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('PERSONAL', [
            'id' => $personal->id,
        ]);
    }
}
