<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('grade'); // نحذف عمود الصف القديم
            $table->foreignId('semester_id')->nullable()->constrained('semesters')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['semester_id']);
            $table->dropColumn('semester_id');
            $table->string('grade'); // نرجع العمود القديم في حالة rollback
        });
    }

};
