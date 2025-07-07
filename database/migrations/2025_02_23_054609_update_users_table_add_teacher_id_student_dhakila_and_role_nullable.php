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
        Schema::table('users', function (Blueprint $table) {
            // Teacher ID Column (Foreign Key, Nullable)
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');

            // Student Dhakila Number Column (Foreign Key, Nullable)
            $table->string('student_dhakila_number')->nullable();
            $table->foreign('student_dhakila_number')->references('dhakila_number')->on('students')->onDelete('set null');

            // Role Column (Nullable, No default value)
            $table->string('role')->nullable()->change();  // Role is nullable now
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key and columns in case of rollback
            $table->dropForeign(['teacher_id']);

            if (Schema::hasColumn('users', 'student_dhakila_number')) {
                $table->dropForeign(['student_dhakila_number']);
                $table->dropColumn('student_dhakila_number');
            }

            $table->dropColumn('teacher_id');
            $table->string('role')->nullable(false)->default('customer')->change();
        });
    }
};
