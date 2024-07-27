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
        Schema::create('USUARIOS', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_fk')->constrained('personal');
            $table->string('nombre_usuario', 100);
            $table->string('contrasena');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('USUARIOS');
    }
};
