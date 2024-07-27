<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuardiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('guardias')->insert([
            ['dia_semana' => 'Lunes'],
            ['dia_semana' => 'Martes'],
            ['dia_semana' => 'Miércoles'],
            ['dia_semana' => 'Jueves'],
            ['dia_semana' => 'Viernes'],
            ['dia_semana' => 'Sábado'],
            ['dia_semana' => 'Domingo'],
        ]);
    }
}
