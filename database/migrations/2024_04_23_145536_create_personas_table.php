<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->string('apellidop', 30)->nullable();
            $table->string('apellidom', 30)->nullable();
            $table->integer('ci')->unique()->nullable();
            $table->string('extension', 2)->nullable();
            $table->string('expedido', 2)->nullable(); // Opcional
            // Eliminar la unicidad de 'genero'
            $table->boolean('genero')->nullable();// Permite nulos
            // Mantén 'nacionalidad' opcional
            $table->string('nacionalidad', 30)->nullable();
            // Eliminar unicidad de 'fnacimiento'
            $table->date('fnacimiento')->nullable();
            // Si quieres que 'whatsapp' sea único, déjalo así, si no, quita `unique()`
            $table->string('whatsapp', 15)->nullable(); 
            $table->string('institucion', 50)->nullable();
            
            $table->unsignedBigInteger('sancion_id')->nullable();
            $table->foreign('sancion_id')->references('id')->on('sancions')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_persona_id')->nullable();
            $table->foreign('tipo_persona_id')->references('id')->on('tipo_personas')->onDelete('cascade');

            $table->string('unidad', 50)->nullable();
            $table->string('cargo', 50)->nullable();
            $table->string('domicilioreal', 50)->nullable();
            $table->string('domiciliolegal', 50)->nullable();
            $table->string('domicilioconvencional', 50)->nullable();
            $table->string('gmail', 50)->nullable();
            $table->date('fecha')->nullable();
            $table->string('foto', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
