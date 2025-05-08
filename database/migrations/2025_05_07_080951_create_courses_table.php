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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');             // اسم الدورة
            $table->string('instructor');        // اسم المدرب
            $table->integer('participants');     // عدد المشاركين
            $table->date('start_date');          // تاريخ بدء الدورة
            $table->date('end_date');            // تاريخ انتهاء الدورة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
