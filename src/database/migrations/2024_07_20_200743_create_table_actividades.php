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
        Schema::create('ACTIVIDADES', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->date('fecha');
            $table->foreignId('usuario_fk')->constrained('usuarios');
            //El personal es el que esta encargado de dicha actividad el usuario es el que la creo
            $table->foreignId('personal_fk')->constrained('personal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ACTIVIDADES');
    }
};
