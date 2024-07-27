<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        $this->call([
            GuardiasSeeder::class,
            RolesSeeder::class,
            TurnosSeeder::class,
            UsuariosSeeder::class,
            PersonalSeeder::class, 
        ]);





    }
}
