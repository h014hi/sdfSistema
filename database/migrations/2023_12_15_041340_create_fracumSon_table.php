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
        Schema::create('fracumson', function (Blueprint $table) {
            $table->unsignedBigInteger('fracumfather_id')->nullable();
            $table->id();
            $table->char('sub_cod',10)->nullable(true);
            $table->text('descripcion')->nullable(true);
            $table->char('calificacion',10)->nullable(false);
            $table->text('m_preventivas')->nullable(true);
            $table->text('consecuencia')->nullable(false);
            $table->decimal('importe',8,2)->nullable(true);
            $table->boolean('descuento')->nullable(true);

            $table->timestamps();

            $table->foreign('fracumfather_id')->references('id')->on('fracumfather')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fracumson');
    }
};
