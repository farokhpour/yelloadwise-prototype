<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_generators', function (Blueprint $table) {
            $table->id();
            $table->string('landing_url'); // HTTP landing URL
            $table->json('utms'); // Array of UTM parameters
            $table->string('generated_link')->unique(); // The final generated link
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->onDelete('set null');
            $table->string('campaign_name')->nullable(); // For display
            $table->string('customer_name')->nullable(); // For display
            $table->string('campaign_type')->nullable(); // For display
            $table->integer('total_clicks')->default(0);
            $table->timestamps();
            
            $table->index('campaign_id');
            $table->index('generated_link');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_generators');
    }
};
