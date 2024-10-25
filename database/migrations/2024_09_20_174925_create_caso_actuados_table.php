<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('caso_actuados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caso_id');
            $table->unsignedBigInteger('actua_id');
            $table->date('fecha')->nullable();
            $table->timestamps();
        
            // Claves foráneas
            $table->foreign('caso_id')->references('id')->on('casos')->onDelete('cascade');
            $table->foreign('actua_id')->references('id')->on('actuas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caso_actuados');
    }
};
