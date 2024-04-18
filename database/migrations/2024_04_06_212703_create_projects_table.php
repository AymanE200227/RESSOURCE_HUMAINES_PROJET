<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->text('other_details')->nullable(); 
            $table->string('estimated_duration')->nullable(); 
            $table->decimal('budget', 10, 2)->nullable(); 
            $table->dateTime('time_start')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
