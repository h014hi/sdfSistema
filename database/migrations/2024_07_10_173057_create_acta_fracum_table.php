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
        Schema::create('acta_fracum', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('acta_id')->nullable();
            $table->foreign('acta_id')->references('id')->on('actas')->onDelete('set null');

            $table->unsignedBigInteger('fracum_id')->nullable();
            $table->foreign('fracum_id')->references('id')->on('fracum')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_fracum');
    }
};
