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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('category_id');
            // $table->foreignId('category_id')->constrained();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('desired_duration');
            $table->string('starting_time');
            $table->string('ending_time');
            // $table->string('timezone')->nullable();
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
