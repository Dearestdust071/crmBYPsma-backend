<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actividad>
 */
class ActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "titulo" => $this->faker->sentence(),
            "descripcion"=> $this->faker->paragraph(),
            "fecha"=> $this->faker->date(),
            "usuario_fk"=> Usuario::factory(),
            "personal_fk"=> Usuario::factory(),

        ];
    }
}
