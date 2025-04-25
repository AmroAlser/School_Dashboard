<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudentEvaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'evaluation',
        'evaluator_name',
        'evaluator_job_number',
        'evaluation_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
