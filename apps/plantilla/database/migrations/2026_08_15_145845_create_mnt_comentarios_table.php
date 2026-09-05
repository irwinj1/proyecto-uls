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
        Schema::create('mnt_comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_tareas')->constrained('mnt_tareas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_comentarios');
    }
};
