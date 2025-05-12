<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Check if an index exists on a table
     */
    private function indexExists($table, $indexName)
    {
        // Use a direct SQL query to check if the index exists
        $schema = DB::connection()->getDatabaseName();
        $result = DB::select("
            SELECT COUNT(*) as index_exists
            FROM information_schema.statistics
            WHERE table_schema = ?
            AND table_name = ?
            AND index_name = ?
        ", [$schema, $table, $indexName]);

        return $result[0]->index_exists > 0;
    }

    /**
     * Run the migrations to add indexes for better performance.
     */
    public function up(): void
    {
        // Add indexes to questionnaire_ones table
        Schema::table('questionnaire_ones', function (Blueprint $table) {
            if (!$this->indexExists('questionnaire_ones', 'questionnaire_ones_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('questionnaire_ones', 'questionnaire_ones_supervisor_id_index')) {
                $table->index('supervisor_id');
            }
            if (!$this->indexExists('questionnaire_ones', 'questionnaire_ones_task_date_index')) {
                $table->index('task_date');
            }
            if (!$this->indexExists('questionnaire_ones', 'questionnaire_ones_status_index')) {
                $table->index('status');
            }
        });

        // Add indexes to questionnaire2s table
        Schema::table('questionnaire2s', function (Blueprint $table) {
            if (!$this->indexExists('questionnaire2s', 'questionnaire2s_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('questionnaire2s', 'questionnaire2s_task_date_index')) {
                $table->index('task_date');
            }
            if (!$this->indexExists('questionnaire2s', 'questionnaire2s_status_index')) {
                $table->index('status');
            }
        });

        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            if (!$this->indexExists('users', 'users_role_index')) {
                $table->index('role');
            }
        });

        // Add indexes to sessions table for better performance
        Schema::table('sessions', function (Blueprint $table) {
            if (!$this->indexExists('sessions', 'sessions_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('sessions', 'sessions_last_activity_index')) {
                $table->index('last_activity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We'll only drop indexes if they exist to avoid errors

        // Remove indexes from questionnaire_ones table
        Schema::table('questionnaire_ones', function (Blueprint $table) {
            if ($this->indexExists('questionnaire_ones', 'questionnaire_ones_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($this->indexExists('questionnaire_ones', 'questionnaire_ones_supervisor_id_index')) {
                $table->dropIndex(['supervisor_id']);
            }
            if ($this->indexExists('questionnaire_ones', 'questionnaire_ones_task_date_index')) {
                $table->dropIndex(['task_date']);
            }
            if ($this->indexExists('questionnaire_ones', 'questionnaire_ones_status_index')) {
                $table->dropIndex(['status']);
            }
        });

        // Remove indexes from questionnaire2s table
        Schema::table('questionnaire2s', function (Blueprint $table) {
            if ($this->indexExists('questionnaire2s', 'questionnaire2s_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($this->indexExists('questionnaire2s', 'questionnaire2s_task_date_index')) {
                $table->dropIndex(['task_date']);
            }
            if ($this->indexExists('questionnaire2s', 'questionnaire2s_status_index')) {
                $table->dropIndex(['status']);
            }
        });

        // Remove indexes from users table
        Schema::table('users', function (Blueprint $table) {
            if ($this->indexExists('users', 'users_role_index')) {
                $table->dropIndex(['role']);
            }
        });

        // Remove indexes from sessions table
        Schema::table('sessions', function (Blueprint $table) {
            if ($this->indexExists('sessions', 'sessions_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($this->indexExists('sessions', 'sessions_last_activity_index')) {
                $table->dropIndex(['last_activity']);
            }
        });
    }
};
