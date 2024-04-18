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
       // Create task_user pivot table
Schema::create('task_user', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('task_id');
    $table->unsignedBigInteger('user_id');
    $table->boolean('started')->default(false);
    $table->boolean('finished')->default(false);
    $table->dateTime('start_time')->nullable();
    $table->dateTime('end_time')->nullable();
    $table->timestamps();

    $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};
