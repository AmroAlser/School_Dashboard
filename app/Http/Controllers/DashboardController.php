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
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // التواريخ للمقارنة
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();
        $startOfYear = $now->copy()->startOfYear();

        // 1. إحصائيات الطلاب
        $studentsCount = Student::count();
        $newStudentsThisMonth = Student::whereBetween('created_at', [$now->startOfMonth(), $now->endOfMonth()])->count();
        $studentsLastMonth = Student::whereBetween('created_at', [$lastMonth->startOfMonth(), $lastMonth->endOfMonth()])->count();
        $studentsIncrease = $studentsLastMonth > 0 ?
            round((($newStudentsThisMonth - $studentsLastMonth) / $studentsLastMonth) * 100, 1) :
            ($newStudentsThisMonth > 0 ? 100 : 0);

        // 2. إحصائيات المعلمين
        $teachersCount = Teacher::count();
        $newTeachersThisMonth = Teacher::whereBetween('created_at', [$now->startOfMonth(), $now->endOfMonth()])->count();
        $teachersLastMonth = Teacher::whereBetween('created_at', [$lastMonth->startOfMonth(), $lastMonth->endOfMonth()])->count();
        $teachersIncrease = $teachersLastMonth > 0 ?
            round((($newTeachersThisMonth - $teachersLastMonth) / $teachersLastMonth) * 100, 1) :
            ($newTeachersThisMonth > 0 ? 100 : 0);

        // 3. إحصائيات الصفوف
        $classesCount = SchoolClass::count();
        $averageStudentsPerClass = $classesCount > 0 ? round($studentsCount / $classesCount, 1) : 0;
        $newClassesThisMonth = SchoolClass::whereBetween('created_at', [$now->startOfMonth(), $now->endOfMonth()])->count();

        // 4. إحصائيات الفصول الدراسية
        $semestersCount = Semester::count();
        $endedSemesters = Semester::where('end_date', '<', $now)->count();
        $currentSemester = Semester::where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->first();

        // 5. بيانات الطلاب حسب الصفوف
        $studentsByClass = SchoolClass::withCount('students')
            ->orderBy('students_count', 'desc')
            ->get()
            ->mapWithKeys(function ($class) {
                return [$class->name => $class->students_count];
            });

        // 6. بيانات المعلمين حسب التخصص
        $teachersBySpecialization = Teacher::select('specialization', DB::raw('count(*) as total'))
            ->groupBy('specialization')
            ->orderBy('total', 'desc')
            ->pluck('total', 'specialization');

        // 7. أحدث الطلاب والمعلمين
        $latestStudents = Student::with('class')
            ->latest()
            ->take(5)
            ->get();

        $latestTeachers = Teacher::latest()
            ->take(5)
            ->get();

        // 8. بيانات الطلاب الجدد شهرياً للسنة الحالية
        $studentsMonthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $studentsMonthlyData[] = Student::whereYear('created_at', $now->year)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // 9. بيانات أداء المعلمين (يمكن استبدالها ببيانات حقيقية)
        $teachersPerformanceData = [];
        for ($month = 1; $month <= 6; $month++) {
            $teachersPerformanceData[] = rand(80, 95); // بيانات عشوائية للتوضيح
        }

        // 10. أحدث البيانات الأخرى
        $latestCourses = Course::latest()->take(5)->get();
        $latestPapers = Paper::latest()->take(5)->get();
        $activeSemesters = Semester::where('end_date', '>=', $now)->get();
        $latestEvaluations = TeacherStudentEvaluation::with(['student', 'teacher'])
            ->latest()
            ->take(5)
            ->get();
        $latestStudent = Student::latest()->first();
        $latestEvaluation = TeacherStudentEvaluation::latest()->first();

        $daysLeft = null;
        if ($currentSemester) {
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($currentSemester->end_date), false);
        }

        return view('dashboard', compact(
            'studentsCount',
            'newStudentsThisMonth',
            'studentsIncrease',
            'teachersCount',
            'newTeachersThisMonth',
            'teachersIncrease',
            'classesCount',
            'averageStudentsPerClass',
            'newClassesThisMonth',
            'semestersCount',
            'endedSemesters',
            'currentSemester',
            'studentsByClass',
            'teachersBySpecialization',
            'latestStudents',
            'latestTeachers',
            'studentsMonthlyData',
            'teachersPerformanceData',
            'latestCourses',
            'latestPapers',
            'activeSemesters',
            'latestEvaluations',
            'latestStudent',
            'latestEvaluation',
            'daysLeft'
        ));
    }
    public function refreshAlerts()
{
    $latestStudent = Student::latest()->first();
    $latestEvaluation = TeacherStudentEvaluation::latest()->first();
    $now = Carbon::now();

    $currentSemester = Semester::where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->first();

    $daysLeft = null;
    if ($currentSemester) {
        $daysLeft = $now->diffInDays(Carbon::parse($currentSemester->end_date), false);
    }

    return response()->json([
        'latest_student' => $latestStudent ? $latestStudent->name . ' (' . $latestStudent->created_at->format('Y-m-d') . ')' : 'لا يوجد طلاب بعد',
        'latest_evaluation' => $latestEvaluation ? $latestEvaluation->title . ' - ' . $latestEvaluation->created_at->format('Y-m-d') : 'لا يوجد تقييمات بعد',
        'days_left' => $daysLeft,
    ]);
}

}
