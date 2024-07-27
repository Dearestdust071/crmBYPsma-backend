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
        Schema::create('GUARDIAS_PERSONAL', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_fk')->constrained('personal');
            $table->foreignId('guardia_fk')->constrained('guardias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GUARDIAS_PERSONAL');
    }
};
