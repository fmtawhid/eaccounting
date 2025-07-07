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
            $table->unsignedBigInteger('brance_id')->nullable()->after('expense_head_id');
            $table->unsignedBigInteger('account_id')->nullable()->after('brance_id');

            $table->foreign('brance_id')->references('id')->on('brances')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['brance_id']);
            $table->dropForeign(['account_id']);
            $table->dropColumn(['brance_id', 'account_id']);
        });
    }


};
