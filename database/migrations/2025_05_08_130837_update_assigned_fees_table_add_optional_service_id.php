<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAssignedFeesTableAddOptionalServiceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('assigned_fees', function (Blueprint $table) {
            // Make fee_category_id nullable
            $table->foreignId('fee_category_id')->nullable()->change();

            // Add optional_service_id foreign key and make it nullable
            $table->foreignId('optional_service_id')->nullable()->constrained('optional_services')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('assigned_fees', function (Blueprint $table) {
            // Drop the optional_service_id column
            $table->dropForeign(['optional_service_id']);
            $table->dropColumn('optional_service_id');

            // Make fee_category_id not nullable again if necessary
            $table->foreignId('fee_category_id')->nullable(false)->change();
        });
    }
}
