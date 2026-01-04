<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade');
            $table->string('route_id')->nullable(); // Query param from device
            $table->string('location')->nullable(); // Query param from device
            $table->json('query_params')->nullable(); // Store all query params for reference
            $table->string('ip_address')->nullable();
            $table->timestamps();
            
            $table->index('device_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_calls');
    }
};
