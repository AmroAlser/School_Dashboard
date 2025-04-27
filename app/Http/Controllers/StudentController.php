<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Exports\AllStudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('class', 'semester');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('national_id', 'like', "%$search%")
                  ->orWhereHas('semester', function($q) use ($search) {
                      $q->where('name', 'like', "%$search%");
                  });
            });
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $students = $query->orderBy('created_at')->paginate(10);

        return view('students.index', compact('students'));
    }
    public function create()
    {
    $semesters = Semester::all(); // عشان الفصل الدراسي
    $classes = SchoolClass::all(); // عشان الصفوف الدراسية

    return view('students.create', compact('semesters', 'classes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|unique:students',
            'name' => 'required',
            'gender' => 'required|in:ذكر,أنثى',
            'birth_date' => 'required|date',
            'semester_id' => 'required|exists:semesters,id', // الفصل الدراسي
            'class_id' => 'required|exists:classes,id', // الصح
            'entry_date' => 'required|date',
            'status' => 'required|in:مواطن,لاجئ',
            'academic_year' => 'required|string',
            'disability' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'guardian_national_id' => 'nullable|string',
            'transferred_from' => 'nullable|string',
            'transferred_to' => 'nullable|string',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'تم إضافة الطالب بنجاح');
    }

    public function show(Student $student)
    {
    $student->load('semester', 'class'); // أضفنا 'class'
    // $classes = SchoolClass::all();
    return view('students.show', compact('student'));
    }


    public function edit(Student $student)
    {
        $semesters = Semester::all();
        $classes = SchoolClass::all();
        return view('students.edit', compact('student', 'semesters', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'national_id' => 'required|unique:students,national_id,' . $student->id,
            'name' => 'required',
            'gender' => 'required|in:ذكر,أنثى',
            'birth_date' => 'required|date',
            'semester_id' => 'required|exists:semesters,id', // الفصل الدراسي
            'class_id' => 'required|exists:classes,id', // الصح
            'entry_date' => 'required|date',
            'status' => 'required|in:مواطن,لاجئ',
            'academic_year' => 'required|string',
            'disability' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'guardian_national_id' => 'nullable|string',
            'transferred_from' => 'nullable|string',
            'transferred_to' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'تم حذف الطالب');
    }

    public function studentexcel()
    {
        return Excel::download(new AllStudentsExport, 'students.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return redirect()->back()->with('success', 'تم استيراد الطلاب بنجاح.');
    }
}
