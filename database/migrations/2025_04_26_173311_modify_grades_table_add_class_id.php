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
        Schema::table('grades', function (Blueprint $table) {
            if (!Schema::hasColumn('grades', 'class_id')) {
                $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
            }
        });

        Schema::table('teacher_student_evaluations', function (Blueprint $table) {
            if (!Schema::hasColumn('teacher_student_evaluations', 'class_id')) {
                $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            if (Schema::hasColumn('grades', 'class_id')) {
                $table->dropForeign(['class_id']);
                $table->dropColumn('class_id');
            }
        });

        Schema::table('teacher_student_evaluations', function (Blueprint $table) {
            if (Schema::hasColumn('teacher_student_evaluations', 'class_id')) {
                $table->dropForeign(['class_id']);
                $table->dropColumn('class_id');
            }
        });
    }
};
