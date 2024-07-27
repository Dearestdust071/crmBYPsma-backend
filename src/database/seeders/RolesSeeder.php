<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ROLES')->insert([
            ['nombre' => 'Operativo'],
            ['nombre' => 'Inactivo'],
            ['nombre' => 'Administrativo'], 
            ['nombre' => 'Jefe de guardia'],
            ['nombre' => 'Jefe de bomberos'],
            ['nombre' => 'Encargado de area'],
        ]);
    }
}
