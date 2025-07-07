<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('teacher_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); // teacher এর সাথে সম্পর্ক
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->timestamps();

            // Teacher টেবিলের সাথে foreign key সম্পর্ক
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_attachments');
    }
}
