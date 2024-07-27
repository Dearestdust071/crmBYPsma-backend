<?php

namespace Database\Factories;

use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "personal_fk"=> Personal::factory(),
            "nombre_usuario"=> $this->faker->userName(),
            "contrasena"=> $this->faker->password(0,10),
        ];
    }
}
