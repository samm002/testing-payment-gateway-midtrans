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
        Schema::create('transactions', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->enum('status', ['unpaid', 'pending', 'paid', 'denied', 'expired', 'canceled'])->nullable();
          $table->string('payment_method')->nullable();
          $table->timestamp('transaction_success_date')->nullable();
          $table->uuid('donation_id');
          $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
