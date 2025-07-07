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
        Schema::table('teachers', function (Blueprint $table) {
            $table->enum('staff_type', ['teacher', 'staff']);
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 3)->nullable();
            $table->string('user_id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['staff_type', 'date_of_birth', 'blood_group', 'user_id']);
        });
    }
};
