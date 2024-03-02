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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code', 60)->unique();
            $table->string('address', 100)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
