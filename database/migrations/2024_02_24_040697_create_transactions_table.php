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
            $table->id();
            $table->string('payment_method');
            $table->enum('status', ['unpaid', 'pending', 'paid']);
            $table->date('transaction_success_date');

            // $table->uuid('donation_id');
            // $table->foreign('donation_id')->references('id')->on('donations');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->nullable();
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
