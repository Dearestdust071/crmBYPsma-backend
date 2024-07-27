<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("TURNOS")->insert([
            ['nombre' => 'Matutina', 'hora_inicio' => '08:00:00', 'hora_fin' => '16:00:00'],
            ['nombre' => 'Vespertina', 'hora_inicio' => '16:00:00', 'hora_fin' => '20:00:00'],
            ['nombre' => 'Nocturna', 'hora_inicio' => '20:00:00', 'hora_fin' => '08:00:00'],
        ]);
    }
}
