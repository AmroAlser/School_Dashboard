<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Exports\GradesExport;
use App\Exports\SemestersExport;


class ReportController extends Controller
{
    public function studentsReport()
    {
        $students = Student::with('semester')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('reports.students', compact('students'));
    }

    public function gradesReport()
    {
        $grades = Grade::with(['student', 'subject', 'semester'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $semesters = Semester::all();
        $subjects = Subject::all();

        return view('reports.grades', compact('grades', 'semesters', 'subjects'));
    }

    public function semestersReport()
    {
        $semesters = Semester::withCount('students')
            ->orderBy('year', 'desc')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('reports.semesters', compact('semesters'));
    }

    public function exportStudentsReport()
    {
        return Excel::download(new StudentsExport, 'students_report.xlsx');
    }

    public function exportGradesReport(Request $request)
    {
        $semester = $request->input('semester');
        $subject = $request->input('subject');

        // تصدير التقرير مع البيانات التي تم تمريرها
        return Excel::download(new GradesExport($semester, $subject), 'grades_report.xlsx');
    }

    public function exportSemestersReport(Request $request)
    {
        $semesterFilter = $request->input('semester_filter');  // افترض أنه هناك فلتر باسم semester_filter في الـ request

    // تصدير التقرير مع الفلاتر المطبقة
    return Excel::download(new SemestersExport($semesterFilter), 'semesters_report.xlsx');
    }
}
