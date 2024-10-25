<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

    Schema::create('persona_tipo_personas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('persona_id');
        $table->unsignedBigInteger('tipo_persona_id');
        $table->unsignedBigInteger('user_id')->nullable(); // Cambia a nullable
        $table->date('fecha')->nullable(); // Columna de fecha opcional

        $table->timestamps();

        $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        $table->foreign('tipo_persona_id')->references('id')->on('tipo_personas')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('persona_tipo_personas'); // Mantén el nombre en singular
}

};