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
         * Schema factura - orden.
         * - id
         * - code = codigo
         * - issue_date = fecha emision
         * - total = total
         * - status = estado
         * - created at
         * - updated at
         */
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code', 60)->unique();
            $table->datetime('issue_date');
            $table->decimal('total')->default(0);
            $table->tinyInteger('status')->default(0); // 0 -> pendiente, 1 -> pagada
            $table->timestamps();

            $table->index(['code', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
