<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add regulator_comment column
        Schema::table('campaigns', function (Blueprint $table) {
            $table->text('regulator_comment')->nullable()->after('status');
        });

        // Update enum to include waiting_for_regulator_approval
        DB::statement("ALTER TABLE campaigns MODIFY COLUMN status ENUM('draft', 'waiting_admin_approval', 'waiting_for_regulator_approval', 'waiting_payment', 'waiting_to_run', 'running', 'completed', 'cancelled') DEFAULT 'draft'");
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('regulator_comment');
        });

        // Revert enum
        DB::statement("ALTER TABLE campaigns MODIFY COLUMN status ENUM('draft', 'waiting_admin_approval', 'waiting_payment', 'waiting_to_run', 'running', 'completed', 'cancelled') DEFAULT 'draft'");
    }
};
