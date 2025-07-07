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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sreni_id')->constrained()->onDelete('cascade'); // Foreign key to Sreni model
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // Foreign key to Subject model
            $table->date('lesson_date'); // Date of lesson
            $table->string('title'); // Title of the lesson
            $table->text('note')->nullable(); // Optional note
            $table->string('pdf_file')->nullable(); // Optional PDF file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
