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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marke_id')->constrained('markes')->onDelete('cascade'); // Car brand ID
            $table->foreignId('model_id')->constrained('model_cars')->onDelete('cascade'); // Car model ID
            $table->year('year'); // Manufacture year
            $table->string('engine_type'); // Engine type (e.g., Petrol, Diesel, Electric)
            $table->string('color'); // Car color
            $table->integer('seats')->nullable(); // Number of seats
            $table->integer('doors')->nullable(); // Number of doors
            $table->decimal('price', 10, 2); // Car price
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available'); // Status of the car
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
