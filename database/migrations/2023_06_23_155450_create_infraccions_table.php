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
        Schema::create('infraccions', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',4)->nullable(false);
            $table->char('tipo',15)->nullable(false);
            $table->text('descripcion')->nullable(false);
            $table->char('calificacion',10)->nullable(false);
            $table->text('m_preventivas',10)->nullable(true);
            $table->text('consecuencia')->nullable(true);
            $table->decimal('importe',8,2)->nullable(true);
            $table->boolean('descuento')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infraccions');
    }
};
