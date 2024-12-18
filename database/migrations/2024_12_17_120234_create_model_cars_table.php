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
        Schema::create('model_cars', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Car model name (e.g., Corolla, X5)
            $table->foreignId('marke_id')->constrained('markes')->onDelete('cascade'); // Foreign key to markes table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_cars');
    }
};
