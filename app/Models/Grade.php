<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['student_id', 'subject_id', 'semester_id', 'score', 'remarks', 'class_id'];

   // تعريف علاقة الدرجة مع الطالب
   public function student()
   {
       return $this->belongsTo(Student::class);
   }

   // تعريف علاقة الدرجة مع الصف
   public function class()
   {
       return $this->belongsTo(SchoolClass::class);
   }

   // تعريف علاقة الدرجة مع المادة
   public function subject()
   {
       return $this->belongsTo(Subject::class);
   }

   // تعريف علاقة الدرجة مع الفصل الدراسي
   public function semester()
   {
       return $this->belongsTo(Semester::class);
   }
}

