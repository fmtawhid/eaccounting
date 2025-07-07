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
        Schema::create('fee_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->decimal('amount', 10, 2);
            $table->boolean('is_recurring')->default(false);
            $table->foreignId('sreni_id')->nullable()->constrained('srenis');
            $table->foreignId('bibag_id')->nullable()->constrained('bibags');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_categories');
    }
};
