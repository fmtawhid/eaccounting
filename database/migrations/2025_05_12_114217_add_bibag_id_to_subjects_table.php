<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // bibag_id ফরেন কী যোগ করা হচ্ছে, তবে এটি nullable হবে
            $table->foreignId('bibag_id')->nullable()->constrained('bibags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // ফরেন কী এবং কলাম মুছে ফেলা হচ্ছে
            $table->dropForeign(['bibag_id']);
            $table->dropColumn('bibag_id');
        });
    }


};
