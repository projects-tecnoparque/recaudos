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
         * Schema contratos.
         * - id
         * - customer_id = cliente id -> foreing to customers
         * - subcategory_id = subcategoria id -> foreing to subcategories
         * - code = codigo
         * - start_date = fecha inicio
         * - end_date = fecha fin
         * - status = estado
         * - created at
         * - updated at
         */
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('code', 60)->unique();
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->tinyInteger('status')->default(1); // 0 -> terminado, 1 -> activo
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->index(['code', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
