<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_generator_id')->constrained('link_generators')->onDelete('cascade');
            $table->date('click_date');
            $table->integer('clicks_count')->default(1);
            $table->timestamps();
            
            $table->index('link_generator_id');
            $table->index('click_date');
            $table->unique(['link_generator_id', 'click_date']); // One record per link per day
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_clicks');
    }
};
