<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add indexes for better performance.
     */
    public function up(): void
    {
        // Add indexes to questionnaire_ones table
        Schema::table('questionnaire_ones', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('supervisor_id');
            $table->index('task_date');
            $table->index('status');
        });

        // Add indexes to questionnaire2s table
        Schema::table('questionnaire2s', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('task_date');
            $table->index('status');
        });

        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });

        // Add indexes to sessions table for better performance
        Schema::table('sessions', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes from questionnaire_ones table
        Schema::table('questionnaire_ones', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['supervisor_id']);
            $table->dropIndex(['task_date']);
            $table->dropIndex(['status']);
        });

        // Remove indexes from questionnaire2s table
        Schema::table('questionnaire2s', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['task_date']);
            $table->dropIndex(['status']);
        });

        // Remove indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        // Remove indexes from sessions table
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['last_activity']);
        });
    }
};
