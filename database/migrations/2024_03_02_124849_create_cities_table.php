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
        /**
         * Schema ciudades - municipios.
         * - id
         * - sectional_id = seccional id -> foreing to sectionals
         * - name = nombre
         * - created at
         * - updated at
         */
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sectional_id');
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('sectional_id')->references('id')->on('sectionals');

            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
