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
         * Schema tipo documentos.
         * - id
         * - abbreviation = abreviatura
         * - name = nombre
         * - created at
         * - updated at
         */
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->char('abbreviation', 3)->unique();
            $table->string('name', 50)->unique();
            $table->timestamps();

            $table->index(['abbreviation', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
