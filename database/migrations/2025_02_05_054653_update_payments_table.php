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
            // roll_number ফিল্ড রিমুভ করা হচ্ছে
            $table->dropColumn('roll_number');

            // নতুন student_id ফরেন কী হিসেবে যোগ করা হচ্ছে
            $table->unsignedBigInteger('student_id')->after('name')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // student_id ফিল্ড ড্রপ করা হচ্ছে
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');


            $table->integer('roll_number')->after('name');
        });
    }
};
