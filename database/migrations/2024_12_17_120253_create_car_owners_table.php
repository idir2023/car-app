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
        Schema::create('car_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Owner's name
            $table->string('email')->unique(); // Owner's email
            $table->string('phone')->nullable(); // Owner's phone
            $table->unsignedBigInteger('user_id'); // Foreign key for users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_owners');
    }
};
