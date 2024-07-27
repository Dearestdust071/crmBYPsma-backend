<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sancion;
use App\Models\Usuario;
use App\Models\Personal;

class SancionTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_create_sancion(): void
    {
        // Crear registros necesarios para la prueba
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        $sancion = Sancion::create([
           "personal_fk" => $personal->id,
            "usuario_fk" => $usuario->id,
            "fecha"=> "2024-07-21 00:12:38",
            "motivo" => "test_sancion"
        ]);

        $this->assertDatabaseHas("SANCIONES", [
            "motivo" => "test_sancion"
        ]);
    }

    public function test_update_sancion(): void
    {
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        // Crear una sanción
        $sancion = Sancion::create([
            "personal_fk" => $personal->id,
            "usuario_fk" => $usuario->id,
            "fecha" => '2024-07-21 00:12:38',
            "motivo" => "test_sancion"
        ]);

        $sancion->update(
            [
                "motivo"=> "updated_sancion"
            ]
        );

        $this->assertDatabaseHas("SANCIONES", [
            "motivo"=>"updated_sancion"
        ]);


    }

    public function test_delete_sancion(): void
    {
        

        // Crear registros necesarios para la prueba
        $personal = Personal::factory()->create();
        $usuario = Usuario::factory()->create();

        // Crear una sanción
        $sancion = Sancion::create([
            "personal_fk" => $personal->id,
            "usuario_fk" => $usuario->id,
            "fecha" => '2024-07-21 00:12:38',
            "motivo" => "test_sancion"
        ]);


        $sancion->delete();

        $this->assertDatabaseMissing("SANCIONES", [
            "motivo"=> "test_sancion"
        ]);
    }




}
