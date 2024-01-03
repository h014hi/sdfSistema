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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('province_id')
                  ->references('id')
                  ->on('provinces')
                  ->onDelete('set null'); // Optional: Define the on delete behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
