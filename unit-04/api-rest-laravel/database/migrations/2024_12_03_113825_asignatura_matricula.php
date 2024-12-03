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
        Schema::create('asignatura_matricula', function (Blueprint $table) {
            $table->unsignedBigInteger('asignaturaid');
            $table->unsignedBigInteger('matriculaid');
            $table->timestamps();
        
            $table->foreign('asignaturaid')->references('id')->on('asignaturas');
            $table->foreign('matriculaid')->references('id')->on('matriculas');
        
            $table->unique(['asignaturaid', 'matriculaid']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura_matricula');
    }
};