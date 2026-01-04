<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('default_videos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('video_file'); // Path to video file
            $table->boolean('show_any_time')->default(false); // Option to show any time
            $table->integer('order')->default(0); // For ordering videos
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('default_videos');
    }
};
