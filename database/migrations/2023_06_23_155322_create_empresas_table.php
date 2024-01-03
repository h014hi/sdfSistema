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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social',300)->nullable(false);
            $table->text('nombres_rep_legal')->nullable(false);
            $table->text('apellidos_rep_legal')->nullable(false);
            $table->integer('dni_rep_legal')->nullable(false);
            $table->string('numero_celular')->nullable(true);
            $table->string('ruc')->nullable(false);
            $table->string('res_funcionamiento')->nullable(true);
            $table->string('partida_electronica')->nullable(true);
            $table->text('domicilio')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
