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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->unsignedBigInteger('bibag_id')->index();
            $table->foreign('bibag_id')->references('id')->on('bibags')->onDelete('cascade');

            $table->unsignedBigInteger('sreni_id')->index();
            $table->foreign('sreni_id')->references('id')->on('srenis')->onDelete('cascade');

            $table->unsignedBigInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('attendance_type_id')->index();
            $table->foreign('attendance_type_id')->references('id')->on('attendance_types')->onDelete('cascade');

            // Additional columns
            $table->date('date');
            $table->string('remark')->default('')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};