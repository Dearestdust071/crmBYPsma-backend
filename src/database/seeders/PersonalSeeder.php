<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Personal;
use App\Models\Rol;
use App\Models\Guardia;
use App\Models\Turno;


class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 registros de personal usando la factory
        $personales = Personal::factory()->count(20)->create();

        // Para cada registro de personal, asociar roles, guardias y turnos
        $personales->each(function ($personal) {
            
        // Asociar un rol al personal en la tabla pivote ROLES_PERSONAL
        $personal->roles()->attach(Rol::inRandomOrder()->first());

            // Asociar una guardia al personal en la tabla pivote GUARDIAS_PERSONAL
            $personal->guardias()->attach(Guardia::inRandomOrder()->first());

            // Asociar un turno al personal en la tabla pivote TURNOS_PERSONAL
            $personal->turnos()->attach(Turno::inRandomOrder()->first());

        });
    }
}
