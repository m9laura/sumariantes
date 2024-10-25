<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->string('exp_adm', 7);
            $table->string('registro_auxiliar', 10);
            $table->text('identificacion_caso', 30);
            $table->string('mae'); //documento
            $table->text('apertura_inicial');

            $table->unsignedBigInteger('tipo_caso_id')->nullable();
            $table->foreign('tipo_caso_id')->references('id')
                ->on('tipo_casos')->onDelete('cascade');


            $table->text('resolucion_final')->nullable();
            $table->text('hoja_ruta')->nullable();
            $table->text('recurso_revocatoria')->nullable();
            $table->text('recurso_jerarquico')->nullable();
            $table->text('ejecutoria')->nullable();
            $table->text('antecedentes')->nullable();
            $table->string('estado_proceso', 50)->nullable();
            $table->timestamp('fecha')->nullable();

            $table->softDeletes(); //boraado logico 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};
