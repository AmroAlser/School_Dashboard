<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'national_id', 'name', 'gender', 'birth_date', 'disability', 'phone',
        'semester_id', 'class_id', 'address', 'entry_date', 'guardian_national_id', 'status',
        'academic_year', 'transferred_from', 'transferred_to','report_image'
    ];


    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function evaluations()
    {
        return $this->hasMany(TeacherStudentEvaluation::class);
    }
    public function class()
    {
    return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
