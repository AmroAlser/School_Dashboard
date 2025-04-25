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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('national_id')->unique();
            $table->string('name');
            $table->enum('gender', ['ذكر', 'أنثى']);
            $table->date('birth_date');
            $table->string('disability')->nullable();
            $table->string('phone')->nullable();
            $table->string('grade');
            $table->string('address')->nullable();
            $table->date('entry_date');
            $table->string('guardian_national_id')->nullable();
            $table->enum('status', ['مواطن', 'لاجئ']);
            $table->string('academic_year');
            $table->string('transferred_from')->nullable();
            $table->string('transferred_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
