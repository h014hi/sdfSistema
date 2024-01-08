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
        Schema::create('infracciones', function (Blueprint $table) {
            $table->unsignedBigInteger('infraccion_id')->nullable();
            $table->id();
            $table->char('sub_cod',2)->nullable(true);
            $table->text('descripcion')->nullable(true);
            $table->char('calificacion',10)->nullable(false);
            $table->text('m_preventivas')->nullable(true);
            $table->text('consecuencia')->nullable(false);
            $table->decimal('importe',8,2)->nullable(true);
            $table->boolean('descuento')->nullable(true);

            $table->timestamps();

            $table->foreign('infraccion_id')->references('id')->on('infraccion')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infracciones');
    }
};
