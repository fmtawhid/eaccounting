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
        Schema::table('students', function (Blueprint $table) {
            // Add the slug column after the student_name column for better organization
            $table->string('slug')->unique()->after('student_name');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['slug']); // Drop the unique constraint first
            $table->dropColumn('slug');
        });
    }
};
