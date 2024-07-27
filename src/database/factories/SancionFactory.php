<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Personal;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sancion>
 */
class SancionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'personal_fk' => Personal::factory(),
                'creador_fk' => Usuario::factory(),
                'fecha' => $this->faker->date,
                'motivo' => $this->faker->paragraph,
        ];
    }
}
