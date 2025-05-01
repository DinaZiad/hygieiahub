<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questionnaire_ones', function (Blueprint $table) {
            $table->id();
            $table->string('housekeeper_name');
            $table->string('unit_number');
            $table->string('service_type'); // scheduled, unscheduled, paid
            $table->string('status_remarks'); // completed, DND, etc.
            $table->json('provided_items')->nullable();
            $table->json('removed_items')->nullable();
            $table->json('general_tasks')->nullable();
            $table->json('bedroom_tasks')->nullable();
            $table->json('bathroom_tasks')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable(); // pending, completed, etc.
            $table->date('task_date')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you have a users table
            $table->timestamps();
            $table->foreignId('supervisor_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_ones');
    }
};
