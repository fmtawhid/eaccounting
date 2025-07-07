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
        Schema::table('payments', function (Blueprint $table) {
            // Remove the student_id foreign key and column
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');

            // Add dhakila_number as foreign key from the students table
            $table->string('dhakila_number')->nullable()->after('name');
            $table->foreign('dhakila_number')->references('dhakila_number')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Remove the dhakila_number foreign key and column
            $table->dropForeign(['dhakila_number']);
            $table->dropColumn('dhakila_number');

            // Add back the student_id column as foreign key
            $table->unsignedBigInteger('student_id')->after('name')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};
