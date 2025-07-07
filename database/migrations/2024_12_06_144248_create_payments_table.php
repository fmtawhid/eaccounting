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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reciept_no')->unique();
            $table->date('date');
            $table->string('name');
            $table->integer('roll_number');
            $table->string('address');
            $table->string('purpose');
            $table->decimal('amount',8,2);
            $table->string('amount_in_words');

            // sreni_id (Foreign Key)
            $table->unsignedBigInteger('sreni_id');
            $table->foreign('sreni_id')->references('id')->on('srenis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
