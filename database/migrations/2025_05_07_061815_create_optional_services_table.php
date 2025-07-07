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
        Schema::create('optional_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');  // 'bus_service', 'day_care_service'
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['accepted', 'rejected'])->default('rejected');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optional_services');
    }
};
