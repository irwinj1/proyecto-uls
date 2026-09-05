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
        Schema::create('mnt_tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_asignado')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_proyecto')->constrained('mnt_proyectos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->string('prioridad', 50);
            $table->date('fecha_finalizacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_tareas');
    }
};
