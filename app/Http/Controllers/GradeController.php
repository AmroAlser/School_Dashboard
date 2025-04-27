<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'semester','class'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $semesters = Semester::all();
        $classes = SchoolClass::all();  // إضافة استعلام لجلب الصفوف

        return view('grades.create', compact('students', 'subjects', 'semesters', 'classes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
            'class_id' => 'required|exists:classes,id',
            'score' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:500',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Grade::create($request->all());

        return redirect()->route('grades.index')
            ->with('success', 'تم إضافة الدرجة بنجاح');
    }

    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $semesters = Semester::all();
        $classes = SchoolClass::all();  // إضافة استعلام لجلب الصفوف
        return view('grades.edit', compact('grade', 'students', 'subjects', 'semesters','classes'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
            'class_id' => 'required|exists:classes,id',
            'score' => 'required|numeric|min:0|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $grade->update($request->all());

        return redirect()->route('grades.index')
            ->with('success', 'تم تحديث الدرجة بنجاح');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
            ->with('success', 'تم حذف الدرجة بنجاح');
    }
}
