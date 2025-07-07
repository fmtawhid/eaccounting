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
            // Add new columns to the teachers table
            $table->string('name');
            $table->string('designation');
            $table->string('image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Drop the columns added in the up method
            $table->dropColumn('name');
            $table->dropColumn('designation');
            $table->dropColumn('image');
        });
    }
};
