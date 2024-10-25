<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('actuas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); // Permite letras, números, guiones y barras
            $table->text('descripcion');// Permite todos los caracteres
            // $table->boolean('estado')->default(true);
            $table->date('fecha');
            $table->string('documentos')->nullable(); // Ruta del archivo mae
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actuas');
    }
};
