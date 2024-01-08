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
        Schema::create('infra__incums', function (Blueprint $table) {
            $table->id();
            $table->char('tipo',30)->nullable(false);

            // relación con infra_padre
            $table->unsignedBigInteger('infracion_id')->nullable(true);
            $table->foreign('infracion_id')->references('id')->on('infraccion')->onDelete('set null');
            // relación con infra_hijo
            $table->unsignedBigInteger('infra_id')->nullable(true);
            $table->foreign('infra_id')->references('id')->on('infracciones')->onDelete('set null');

            // relación con infra_padre
            $table->unsignedBigInteger('incumplimiento_id')->nullable(true);
            $table->foreign('incumplimiento_id')->references('id')->on('incumplimiento')->onDelete('set null');
            // relación con incumplimientos
            $table->unsignedBigInteger('incum_id')->nullable(true);
            $table->foreign('incum_id')->references('id')->on('incumplimientos')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infra__incums');
    }
};
