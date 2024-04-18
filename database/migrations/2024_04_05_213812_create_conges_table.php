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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); // Make it nullable
            $table->string('_token')->nullable();
            $table->string('type_conge');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->string('statut')->default('En attente');
            $table->timestamps();
        
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
