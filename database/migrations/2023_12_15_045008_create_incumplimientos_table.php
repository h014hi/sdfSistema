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
        Schema::create('incumplimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('incumplimiento_id')->nullable();
            $table->id();
            $table->char('articulo',10)->nullable(false);
            $table->text('numeral')->nullable(false);
            $table->char('calificacion',10)->nullable(false);
            $table->text('m_preventivas')->nullable(true);
            $table->text('consecuencia')->nullable(true);

            $table->timestamps();

            $table->foreign('incumplimiento_id')->references('id')->on('incumplimiento')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incumplimientos');
    }
};
