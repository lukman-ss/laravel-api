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
        Schema::create('course_secret_key', function (Blueprint $table) {
            $table->foreignId('course_scheduled_id')->constrained('course_scheduled')->onDelete('cascade')->onUpdate('cascade');
            $table->string('key')->unique();
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_secret_key_models');
    }
};
