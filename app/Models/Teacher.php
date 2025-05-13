<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'national_id',
        'job_number',
        'specialization',
        'subject_id',
        'class_id',
        'tasks',
        'task_date',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
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
