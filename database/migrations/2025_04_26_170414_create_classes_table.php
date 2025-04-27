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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الصف مثلا: الصف الأول الأساسي
            $table->timestamps();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });

        Schema::dropIfExists('classes');
    }
};
