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
        Schema::table('students', function (Blueprint $table) {
            // Add 'bibag_id' as an unsigned big integer
            $table->unsignedBigInteger('bibag_id')->nullable();
            $table->foreign('bibag_id')->references('id')->on('bibags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['bibag_id']);
            
            // Then, drop the 'bibag_id' column
            $table->dropColumn('bibag_id');
        });
    }
};
