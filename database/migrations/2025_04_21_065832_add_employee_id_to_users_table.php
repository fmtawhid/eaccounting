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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable()->after('id');

            $table->foreign('employee_id')
                ->references('user_id')
                ->on('teachers')
                ->onDelete('set null');
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employee_id']); // ফরেন কী কনস্ট্রেইন্ট ড্রপ করা
            $table->dropColumn('employee_id'); // কলাম ড্রপ করা
        });
    }

};
