<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTypeColumnInStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the 'type' column in the 'students' table
        Schema::table('students', function (Blueprint $table) {
            // Modify the enum values of 'type'
            $table->enum('type', ['active', 'deactive'])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the 'type' column back to the previous state
        Schema::table('students', function (Blueprint $table) {
            $table->enum('type', ['admission', 'active_student'])->default('admission')->change();
        });
    }
}
