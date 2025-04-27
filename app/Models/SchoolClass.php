<?php

// app/Models/SchoolClass.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes'; // ضروري نحدد اسم الجدول لأنه جمع غير اعتيادي
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
      // تعريف علاقة الفصل مع الدرجات
      public function grades()
      {
          return $this->hasMany(Grade::class);
      }

      // تعريف علاقة الفصل مع التقييمات
      public function evaluations()
      {
          return $this->hasMany(TeacherStudentEvaluation::class);
      }

      // تعريف علاقة الفصل مع الفصل الدراسي (Semester)
      public function semester()
      {
          return $this->belongsTo(Semester::class);
      }
}

