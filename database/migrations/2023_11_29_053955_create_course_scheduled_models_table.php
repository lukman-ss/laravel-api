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
        Schema::create('course_scheduled', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('course')->onDelete('cascade')->onUpdate('cascade');
            $table->string('scheduled_name',  100);
            $table->date('scheduled_start');
            $table->date('scheduled_end');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_scheduled_models');
    }
};
