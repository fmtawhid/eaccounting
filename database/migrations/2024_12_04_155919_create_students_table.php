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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // Form Number (Unique)
            $table->string('form_number')->unique();
            
            // Dhakila Number (Unique)
            $table->string('dhakila_number')->unique();
            
            // Dhakila Date
            $table->date('dhakila_date');
            
            // Student Name
            $table->string('student_name');
            
            // Father Name
            $table->string('father_name');
            
            // Mobile
            $table->string('mobile', 15); // Adjust length as needed
            
            // District
            $table->string('district');
            
            // Academic Session
            $table->string('academic_session');
            
            // sreni_id (Foreign Key)
            $table->unsignedBigInteger('sreni_id');
            $table->foreign('sreni_id')->references('id')->on('srenis')->onDelete('cascade');
            
            // Roll Number
            $table->integer('roll_number');
            
            // Type (Enum: admission, active_student)
            $table->enum('type', ['admission', 'active_student'])->default('admission');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};