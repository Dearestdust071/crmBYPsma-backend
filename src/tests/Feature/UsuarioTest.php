<?php

namespace Tests\Unit;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Personal;

class UsuarioTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;




    public function test_create_usuario():void 
    {
        $personal = Personal::factory()->create();        
            
        $usuario = Usuario::create(
            [
                "personal_fk"=> $personal->id,
                "nombre_usuario"=> "PruebaUsuario",
                "contrasena"=> "contrasenaPrueba",
            ]
        );

        $this->assertDatabaseHas("USUARIOS", [
            "personal_fk"=> $personal->id,
            "nombre_usuario"=> "PruebaUsuario",
            "contrasena"=> "contrasenaPrueba",
        ]);
    }


    //test update
    public function test_update_usuario(): void
{
    
    $personal = Personal::factory()->create();        

    
    $usuario = Usuario::create(
        [
            "personal_fk" => $personal->id,
            "nombre_usuario" => "PruebaUsuario",
            "contrasena" => "contrasenaPrueba",
        ]
    );

    
    $usuario->update(
        [
            "nombre_usuario" => "UsuarioActualizado",
            "contrasena" => "contrasenaActualizada",
        ]
    );

   
    $this->assertDatabaseHas("USUARIOS", [
        "personal_fk" => $personal->id,
        "nombre_usuario" => "UsuarioActualizado",
        "contrasena" => "contrasenaActualizada",
    ]);
}


public function test_delete_usuario(): void
{
    // Crea un registro de Personal
    $personal = Personal::factory()->create();        

    // Crea un registro de Usuario
    $usuario = Usuario::create(
        [
            "personal_fk" => $personal->id,
            "nombre_usuario" => "PruebaUsuario",
            "contrasena" => "contrasenaPrueba",
        ]
    );

    // Elimina el registro de Usuario
    $usuario->delete();

    // Verifica que el registro de Usuario haya sido eliminado
    $this->assertDatabaseMissing("USUARIOS", [
        "personal_fk" => $personal->id,
        "nombre_usuario" => "PruebaUsuario",
        "contrasena" => "contrasenaPrueba",
    ]);
}







}
