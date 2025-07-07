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
            // Add the column only if it doesn't already exist
            if (!Schema::hasColumn('payments', 'purpose_id')) {
                $table->unsignedBigInteger('purpose_id');
                $table->foreign('purpose_id')->references('id')->on('purposes')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            if (Schema::hasColumn('payments', 'purpose_id')) {
                $table->dropForeign(['purpose_id']);
                $table->dropColumn('purpose_id');
            }
        });
    }
};
