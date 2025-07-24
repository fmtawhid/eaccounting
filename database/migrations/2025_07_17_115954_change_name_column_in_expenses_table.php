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
    Schema::table('expenses', function (Blueprint $table) {
        // Drop old string column if exists
        if (Schema::hasColumn('expenses', 'name')) {
            $table->dropColumn('name');
        }

        // Add new foreign key column
        $table->unsignedBigInteger('name')->nullable()->after('expense_head_id');

        $table->foreign('name')->references('id')->on('expense_names')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('expenses', function (Blueprint $table) {
        $table->dropForeign(['name']);
        $table->dropColumn('name');

        $table->string('name')->nullable(); // revert back to string if rolled back
    });
}

};
