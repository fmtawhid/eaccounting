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
        Schema::table('sreni_sections', function (Blueprint $table) {
            // Add bibag_id as foreign key to Bibag model
            $table->foreignId('bibag_id')->nullable()->constrained('bibags')->onDelete('cascade');

            // Add sreni_id as foreign key to Sreni model
            $table->foreignId('sreni_id')->nullable()->constrained('srenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sreni_sections', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['bibag_id']);
            $table->dropForeign(['sreni_id']);

            // Drop columns
            $table->dropColumn('bibag_id');
            $table->dropColumn('sreni_id');
        });
    }
};
