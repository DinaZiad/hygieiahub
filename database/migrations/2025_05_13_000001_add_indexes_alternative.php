<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to add indexes for better performance.
     */
    public function up(): void
    {
        // Add indexes to questionnaire_ones table
        try {
            Schema::table('questionnaire_ones', function (Blueprint $table) {
                $table->index('user_id');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('questionnaire_ones', function (Blueprint $table) {
                $table->index('supervisor_id');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('questionnaire_ones', function (Blueprint $table) {
                $table->index('task_date');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('questionnaire_ones', function (Blueprint $table) {
                $table->index('status');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }

        // Add indexes to questionnaire2s table
        try {
            Schema::table('questionnaire2s', function (Blueprint $table) {
                $table->index('user_id');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('questionnaire2s', function (Blueprint $table) {
                $table->index('task_date');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('questionnaire2s', function (Blueprint $table) {
                $table->index('status');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }

        // Add indexes to users table
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->index('role');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }

        // Add indexes to sessions table for better performance
        try {
            Schema::table('sessions', function (Blueprint $table) {
                $table->index('user_id');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
        
        try {
            Schema::table('sessions', function (Blueprint $table) {
                $table->index('last_activity');
            });
        } catch (\Exception $e) {
            // Index might already exist, continue
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't implement the down method as it could cause issues
        // if we try to drop indexes that don't exist
    }
};
