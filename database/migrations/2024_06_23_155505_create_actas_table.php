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
        Schema::create('actas', function (Blueprint $table) {
            $table->id();

            $table->string('estado',150)->nullable(false);
            $table->string('agente',30)->nullable(true);
            $table->string('numero',150)->nullable(false);

            $table->text('retencion');
            $table->string('ruta')->nullable(true);

            $table->text('obs_intervenido')->nullable(true);
            $table->text('obs_inspector')->nullable(true);
            $table->text('obs_acta')->nullable(true);

            // relación con operativos
            $table->unsignedBigInteger('operativo_id')->nullable();
            $table->foreign('operativo_id')->references('id')->on('operativos')->onDelete('set null');

            // relacion con empresas
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');

            // relacion con inspectores
            $table->unsignedBigInteger('inspector_id')->nullable();
            $table->foreign('inspector_id')->references('id')->on('inspectors')->onDelete('set null');

            //relacion con conductores
            $table->unsignedBigInteger('conductor_id')->nullable();
            $table->foreign('conductor_id')->references('id')->on('conductors')->onDelete('set null');

            //relacion con infraccion
            $table->unsignedBigInteger('infraccion_id')->nullable(true);
            $table->foreign('infraccion_id')->references('id')->on('infraccions')->onDelete('set null');

            //Nueva relacion con infra_incum
            $table->unsignedBigInteger('infra_incum_id')->nullable();
            $table->foreign('infra_incum_id')->references('id')->on('infra__incums')->onDelete('set null');

            //relacion con vehiculos intervenidos
            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('set null');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
