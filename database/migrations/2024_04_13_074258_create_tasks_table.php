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
        // Create tasks table
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable(); // Add assigned_to column
            $table->enum('status', ['assigned', 'started', 'finished', 'not assigned'])->default('not assigned'); // Assuming you have a status column
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('started_by_user_id')->nullable();
            $table->unsignedBigInteger('finished_by_user_id')->nullable();

            // Foreign key constraints
            $table->foreign('started_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('finished_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
