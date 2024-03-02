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
         * Schema productos.
         * - id
         * - contract_id = contrato id -> foreing to contracts
         * - product_status_id = estado producto id -> foreing to product_statuses
         * - code = codigo
         * - name = nombre
         * - created at
         * - updated at
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('product_status_id');
            $table->string('code', 60)->unique();
            $table->string('name', 400);
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('product_status_id')->references('id')->on('product_statuses');

            $table->index(['code', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
