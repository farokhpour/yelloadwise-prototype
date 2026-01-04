<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_id')->unique(); // Fake UUID for display
            $table->enum('type', ['OTP', 'WALLET', 'ORDER']);
            $table->enum('status', ['PENDING', 'APPROVED', 'RETURNED'])->default('PENDING');
            $table->json('config'); // Store template-specific configuration
            $table->text('preview')->nullable(); // Generated preview text
            $table->text('admin_comment')->nullable(); // Admin comment when returned
            $table->timestamps();
            
            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
