<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Personal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asistencia>
 */
class AsistenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "personal_fk" => Personal::factory(),
            "fecha"=> $this->faker->date(),
            "presente" => $this->faker->boolean(50),
            "chequeo_material"=> $this->faker->boolean(20), 
            "usuario_fk"=> Usuario::factory(),
        ];
    }
}
