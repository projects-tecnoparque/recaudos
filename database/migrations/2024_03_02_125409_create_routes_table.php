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
         * Schema rutas.
         * - id
         * - cycle_id = ciclo id -> foreing to cycles
         * - code = codigo
         * - name = nombre
         * - created at
         * - updated at
         */
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cycle_id');
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('cycle_id')->references('id')->on('cycles');

            $table->index(['code', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
