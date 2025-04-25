<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\TeacherStudentEvaluation;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $subjectsCount = Subject::count();
        $evaluationsCount = TeacherStudentEvaluation::count();

        return view('dashboard', compact(
            'studentsCount',
            'teachersCount',
            'subjectsCount',
            'evaluationsCount'
        ));
    }
}

