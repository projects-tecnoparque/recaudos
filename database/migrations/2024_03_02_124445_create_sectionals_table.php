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
         * Schema seccionales.
         * - id
         * - operational_sector_id = sector operacional id -> foreing to operational_sectors
         * - code = codigo
         * - name = nombre
         * - slug = slug
         * - created at
         * - updated at
         */
        Schema::create('sectionals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operational_sector_id');
            $table->string('code', 20)->unique();
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->timestamps();

            $table->foreign('operational_sector_id')->references('id')->on('operational_sectors');

            $table->index(['code', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectionals');
    }
};
