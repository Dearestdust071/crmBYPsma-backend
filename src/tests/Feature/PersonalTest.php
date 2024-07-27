<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\VoidType;
use Tests\TestCase;
use App\Models\Personal;

class PersonalTest extends TestCase
{
    
    use RefreshDatabase;

    public $personal = [
        "nombre"=> "NombreEjemplo",
        "apellido_paterno"=> "apellidoMaternoEjemplo",
        "apellido_materno"=> "apellidoMaternoEjemplo",
        "numero_telefono"=> "4151676050",
    ];

    public $personalUpdate = [
        "nombre"=> "NombreUpdated",
        "apellido_paterno"=> "ApellidoUpdated",
        "apellido_materno"=> "apellidoMaternoEjemplo",
        "numero_telefono"=> "123123123",
    ];

    public function test_create_personal(): void
    {
        Personal::create($this->personal);
        $this->assertDatabaseHas("PERSONAL", $this->personal);
    }

    public function test_update_personal(): void
    {   
        $persoanalPrueba = Personal::create($this->personal);
        $persoanalPrueba->update($this->personalUpdate);
        $this->assertDatabaseHas("PERSONAL", $this->personalUpdate);
    }

    public function test_delete_personal(): void
    {
        $personal = Personal::create($this->personal);
        $personal->delete();
        $this->assertDatabaseMissing("PERSONAL", $this->personal);
    }


}
