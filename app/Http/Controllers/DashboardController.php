<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\SchoolClass;
use App\Models\TeacherStudentEvaluation; // التأكد من استخدام اسم الموديل الصحيح

class DashboardController extends Controller
{
    public function index()
    {
        // counts for stat cards (الأعداد الإجمالية للبطاقات العلوية)
        $studentsCount = Student::count();
        $teachersCount = Teacher::count();
        $subjectsCount = Subject::count();
        $semestersCount = Semester::count();
        $evaluationsCount = TeacherStudentEvaluation::count();
        $classesCount = SchoolClass::count();

        // Data for 'Latest' sections (جلب أحدث السجلات للأقسام السفلية)
        // يمكنك تعديل الرقم (مثلاً 5) لتغيير عدد السجلات التي تظهر
        $latestStudents = Student::latest()->take(5)->with('class')->get(); // جلب آخر 5 طلاب مع علاقتهم بالصف
        $latestEvaluations = TeacherStudentEvaluation::latest()->take(5)->with(['student', 'teacher'])->get(); // جلب آخر 5 تقييمات مع علاقتهم بالطلاب والمعلمين
        $latestClasses = SchoolClass::latest()->take(5)->withCount('students')->get(); // جلب آخر 5 صفوف مع عدد طلاب كل صف

        // Note: Data for charts (studentsChart, teachersChart) is not fetched in this controller
        // as the Blade template only has the <canvas> tags without actual chart data implementation.
        // If you implement charts later, you'll need to fetch and format the required data here.

        // Note: The percentage/new counts in the stat cards are hardcoded in your Blade.
        // Making them dynamic requires more complex logic here (e.g., calculating growth).

        // Pass all necessary data to the view
        return view('dashboard', compact(
            'studentsCount',
            'teachersCount',
            'subjectsCount',
            'evaluationsCount',
            'semestersCount',
            'classesCount',
            'latestStudents',    // Added latest students data
            'latestEvaluations', // Added latest evaluations data
            'latestClasses'      // Added latest classes data
        ));
    }
}
