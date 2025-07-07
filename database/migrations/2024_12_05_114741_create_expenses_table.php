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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            // expense_head_id (Foreign Key)
            $table->unsignedBigInteger('expense_head_id');
            $table->foreign('expense_head_id')->references('id')->on('expense_heads')->onDelete('cascade');

            $table->string('name');
            $table->string('invoice_no')->unique();

            $table->date('date');
            $table->decimal('amount',8,2);

            $table->string('note');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
