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
            // নতুন ফিল্ড গুলি যোগ করা হচ্ছে
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable(); 
            $table->string('facebook_link')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->string('qualification')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('years_of_experience')->nullable();
            $table->string('department')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // শুধুমাত্র নতুন ফিল্ড গুলি বাদ দেয়া হচ্ছে
            $table->dropColumn('phone_number');
            $table->dropColumn('email');
            $table->dropColumn('address');
            $table->dropColumn('facebook_link');
            $table->dropColumn('date_of_joining');
            $table->dropColumn('salary');
            $table->dropColumn('qualification');
            $table->dropColumn('status');
            $table->dropColumn('years_of_experience');
            $table->dropColumn('department');
        });
    }
};
