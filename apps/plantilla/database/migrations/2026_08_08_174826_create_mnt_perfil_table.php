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
        Schema::create('mnt_perfil', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('sexo', 10)->nullable();
            $table->date('fecha_nac');
            $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_perfil');
    }
};
