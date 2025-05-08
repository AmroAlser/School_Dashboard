<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\SchoolClass;
use App\Models\TeacherStudentEvaluation;
use App\Models\Course;
use App\Models\Paper;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات البطاقات العلوية
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $classesCount = SchoolClass::count();
        $semestersCount = Semester::count();

        // بيانات قسم الطلاب
        $latestStudents = Student::latest()->take(5)->with('class')->get();
        $studentsByClass = SchoolClass::withCount('students')->get()
            ->mapWithKeys(function ($class) {
                return [$class->name => $class->students_count];
            });

        // بيانات قسم الدورات
        $latestCourses = Course::latest()->take(5)->get();

        // بيانات قسم الأوراق والتقارير
        $latestPapers = Paper::latest()->take(5)->get();

        // بيانات قسم الفصول الدراسية النشطة
        $activeSemesters = Semester::where('end_date', '>=', now())->get();

        // بيانات قسم أحدث التقييمات
        $latestEvaluations = TeacherStudentEvaluation::latest()->take(5)->with(['student', 'teacher'])->get();

        return view('dashboard', compact(
            'studentsCount',
            'teachersCount',
            'classesCount',
            'semestersCount',
            'latestStudents',
            'studentsByClass',
            'latestCourses',
            'latestPapers',
            'activeSemesters',
            'latestEvaluations'
        ));
    }
}
