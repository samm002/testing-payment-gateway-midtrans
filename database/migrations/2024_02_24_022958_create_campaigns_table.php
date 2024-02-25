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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('campaign_type', ['kemanusiaan', 'kesehatan', 'pendidikan', 'tanggap bencana']);
            $table->decimal('current_donation', 12, 2)->default(0);
            $table->decimal('target_donation', 12, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->string('campaign_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
