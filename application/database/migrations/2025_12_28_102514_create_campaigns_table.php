<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('video_file')->nullable(); // Path to video in MinIO
            $table->integer('days');
            $table->integer('cars');
            $table->json('locations'); // Array of selected locations (multi-select)
            $table->string('link')->nullable();
            $table->json('utms')->nullable(); // UTM parameters as JSON
            $table->decimal('cost_per_day', 10, 2)->nullable(); // Admin sets this
            $table->enum('status', [
                'draft',
                'waiting_admin_approval',
                'waiting_payment',
                'waiting_to_run',
                'running',
                'completed',
                'cancelled'
            ])->default('draft');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
