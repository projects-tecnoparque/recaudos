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
         * Schema ciclos.
         * - id
         * - city_id = ciudad id -> foreing to cities
         * - code = codigo
         * - name = nombre
         * - created at
         * - updated at
         */
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->string('code', 20)->unique();
            $table->string('name', 60);
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');

            $table->index(['code', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
