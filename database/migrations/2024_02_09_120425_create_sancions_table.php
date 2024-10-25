<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sancions', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' auto incremental
            $table->string('nombre', 100); // Columna para el nombre, max 100 caracteres
            $table->text('descripcion'); // Columna para la descripción
            $table->boolean('estado')->default(true); // Columna para estado, por defecto true
            $table->date('fecha'); // Columna para la fecha
            $table->softDeletes(); // Columna para borrado lógico
            $table->timestamps(); // Añade created_at y updated_at
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sancions'); // Elimina la tabla si existe
    }
};
