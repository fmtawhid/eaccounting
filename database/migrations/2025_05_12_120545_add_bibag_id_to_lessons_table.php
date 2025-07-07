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
        Schema::table('lessons', function (Blueprint $table) {
            // Add bibag_id as foreign key to Bibag model
            $table->foreignId('bibag_id')->nullable()->constrained('bibags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            // Drop the bibag_id foreign key if rolling back
            $table->dropForeign(['bibag_id']);
            $table->dropColumn('bibag_id');
        });
    }
};
