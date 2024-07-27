<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ROLES_USUARIOS', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_fk')->constrained('usuarios');
            $table->foreignId('rol_fk')->constrained('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ROLES_USUARIOS');
    }
};
