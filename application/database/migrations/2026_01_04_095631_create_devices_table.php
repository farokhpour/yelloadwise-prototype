<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->unique();
            $table->enum('status', ['live', 'offline'])->default('offline');
            $table->timestamp('last_status_updated_at')->nullable();
            $table->string('default_route');
            $table->string('owner_first_name');
            $table->string('owner_last_name');
            $table->string('owner_national_id');
            $table->string('documents_file')->nullable(); // Path to uploaded documents
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
