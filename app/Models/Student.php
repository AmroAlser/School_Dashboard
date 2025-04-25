<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'national_id',
        'name',
        'gender',
        'birth_date',
        'disability',
        'phone',
        'grade',
        'address',
        'entry_date',
        'guardian_national_id',
        'status',
        'academic_year',
        'transferred_from',
        'transferred_to',
    ];

    public function evaluations()
    {
        return $this->hasMany(TeacherStudentEvaluation::class);
    }
}
