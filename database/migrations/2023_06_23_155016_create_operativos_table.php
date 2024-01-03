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
        Schema::create('operativos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable(false);
            $table->string('lugar',150)->nullable(false);
            $table->string('provincia',150)->nullable(false);
            $table->string('distrito',150)->nullable(true);
            $table->date('fecha')->nullable(false);
            $table->integer('diashabiles')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operativos');
    }
};
