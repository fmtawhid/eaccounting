<?php

// database/migrations/xxxx_xx_xx_create_expense_names_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseNamesTable extends Migration
{
    public function up()
    {
        Schema::create('expense_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_names');
    }
}
