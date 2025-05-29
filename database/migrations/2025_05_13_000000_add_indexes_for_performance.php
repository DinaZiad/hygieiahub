<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Check if an index exists on a table (PostgreSQL compatible).
     */
    private function indexExists($table, $indexName)
    {
        $result = DB::select("SELECT 1 FROM pg_indexes WHERE tablename = ? AND indexname = ?", [$table, $indexName]);

        return count($result) > 0;
    }

    /**
     * Run the migrations to add indexes for better performance.
     */
    public function up(): void
    {
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

        Schema::table('users', function (Blueprint $table) {
            if (!$this->indexExists('users', 'users_role_index')) {
                $table->index('role');
            }
        });

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
        Schema::table('questionnaire_ones', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['supervisor_id']);
            $table->dropIndex(['task_date']);
            $table->dropIndex(['status']);
        });

        Schema::table('questionnaire2s', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['task_date']);
            $table->dropIndex(['status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['last_activity']);
        });
    }
};
