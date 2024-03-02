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
         * Schema pago.
         * - id
         * - invoice_id = factura/orden id -> foreing to invoices
         * - bill_collector = cobrador id -> foreing to users
         * - code = codigo
         * - date = fecha pago
         * - payment_method = metodo de pago
         * - amount = monto pago
         * - created at
         * - updated at
         */
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('bill_collector');
            $table->string('code', 60)->unique();
            $table->datetime('date');
            $table->string('payment_method', 100);
            $table->decimal('amount')->default(0);
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('bill_collector')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
