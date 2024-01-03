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
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable(true);
            $table->string('apellidos')->nullable(true);
            $table->char('dni',8)->nullable(true);
            $table->char('licencia',9)->nullable(true);
            $table->string('categoria')->nullable(false);
            $table->string('estadolicencia')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductors');
    }
};
