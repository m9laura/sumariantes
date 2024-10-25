<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('sancionpersonas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('sancion_id');
            $table->date('fecha')->nullable(); // Columna de fecha opcional
            $table->timestamps();
            // Definir las claves foráneas
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('sancion_id')->references('id')->on('sancions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sancionpersonas');
    }
};