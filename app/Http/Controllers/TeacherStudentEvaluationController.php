<?php

namespace App\Http\Controllers;

use App\Models\TeacherStudentEvaluation;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherStudentEvaluationController extends Controller
{
    public function index()
    {
        $evaluations = TeacherStudentEvaluation::with(['teacher', 'student'])->oldest()->get();
        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $students = Student::all();
        return view('evaluations.create', compact('teachers', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'evaluation' => 'required|string',
            'evaluator_name' => 'required|string',
            'evaluator_job_number' => 'required|string',
            'evaluation_date' => 'required|date',
        ]);

        TeacherStudentEvaluation::create($request->all());
        return redirect()->route('evaluations.index')->with('success', 'تم إضافة التقييم بنجاح');
    }

    public function show(TeacherStudentEvaluation $evaluation)
    {
        return view('evaluations.show', compact('evaluation'));
    }

    public function edit(TeacherStudentEvaluation $evaluation)
    {
        $teachers = Teacher::all();
        $students = Student::all();
        return view('evaluations.edit', compact('evaluation', 'teachers', 'students'));
    }

    public function update(Request $request, TeacherStudentEvaluation $evaluation)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'evaluation' => 'required|string',
            'evaluator_name' => 'required|string',
            'evaluator_job_number' => 'required|string',
            'evaluation_date' => 'required|date', 
        ]);

        $evaluation->update($request->all());
        return redirect()->route('evaluations.index')->with('success', 'تم تحديث التقييم بنجاح');
    }

    public function destroy(TeacherStudentEvaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', 'تم حذف التقييم بنجاح');
    }
}
