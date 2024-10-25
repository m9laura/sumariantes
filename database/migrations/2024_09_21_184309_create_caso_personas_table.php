<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('caso_personas', function (Blueprint $table) {
          
                $table->id();
                $table->unsignedBigInteger('caso_id');
                $table->unsignedBigInteger('persona_id');
                $table->date('fecha')->nullable(); // Permitir nulos en el campo 'fecha' // Campo de fecha
                $table->timestamps();
            
                $table->foreign('caso_id')->references('id')->on('casos')->onDelete('cascade');
                $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            });
        }
        public function down(): void
    {
        Schema::dropIfExists('caso_personas');
    }
};
