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
        Schema::create('inspectors', function (Blueprint $table) {
            $table->id();
            $table->char('acreditado',3);
            $table->string('nombres')->nullable(false);
            $table->string('apellidos')->nullable(false);
            $table->char('dni',8)->nullable(true);
            $table->char('telefono','9')->nullable(true);
            $table->char('rdrauto','4')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspectors');
    }
};
