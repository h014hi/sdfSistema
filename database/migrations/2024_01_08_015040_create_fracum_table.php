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
        Schema::create('fracum', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',30)->nullable(false);

            $table->unsignedBigInteger('fracumfather_id')->nullable();
            $table->foreign('fracumfather_id')->references('id')->on('fracumfather')->onDelete('set null');

            $table->unsignedBigInteger('fracumson_id')->nullable(true);
            $table->foreign('fracumson_id')->references('id')->on('fracumson')->onDelete('set null');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fracum');
    }
};
