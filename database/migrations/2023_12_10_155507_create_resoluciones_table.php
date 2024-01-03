<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resolucions', function (Blueprint $table) {
            $table->id();
            $table->string('n_resolucion')->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->text('detalle')->nullable(true);

            // relación con operativos
            $table->unsignedBigInteger('acta_id')->nullable();
            $table->foreign('acta_id')->references('id')->on('actas')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resolucions');
    }
};
