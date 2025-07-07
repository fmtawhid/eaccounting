<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // New Fields Added
            $table->string('image')->nullable(); // Image field (nullable)
            $table->string('email')->nullable(); // Email field (nullable)
            $table->string('emergency_contact')->nullable(); // Emergency contact (nullable)
            $table->date('date_of_birth')->nullable(); // Date of Birth (nullable)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Remove the added fields if rolled back
            $table->dropColumn(['image', 'email', 'emergency_contact', 'date_of_birth']);
        });
    }
}
