<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('course_secret_key', function (Blueprint $table) {
            $table->softDeletes();
            // Add more fields as needed
        });
    }

    public function down()
    {
        Schema::table('course_secret_key', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
