<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        // الحصول على جميع المواد
        $subjects = Subject::all();

        // البحث والتصفية حسب المادة والاسم
        $teachers = Teacher::when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%')
                             ->orWhere('national_id', 'like', '%' . $request->search . '%')
                             ->orWhere('specialization', 'like', '%' . $request->search . '%');
            })
            ->when($request->subject_id, function ($query) use ($request) {
                return $query->where('subject_id', $request->subject_id);
            })
            ->paginate(10);

        // تمرير المتغيرات إلى العرض
        return view('teachers.index', compact('teachers', 'subjects'));
    }



    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'national_id' => 'required|unique:teachers,national_id',
            'job_number' => 'nullable|unique:teachers,job_number',
            'specialization' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'tasks' => 'nullable|string',
            'task_date' => 'nullable|date',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'تم إضافة المعلم بنجاح');
    }
    public function show(Teacher $teacher)
    {
    return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'national_id' => 'required|unique:teachers,national_id,' . $teacher->id,
            'job_number' => 'nullable|unique:teachers,job_number,' . $teacher->id,
            'specialization' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'tasks' => 'nullable|string',
            'task_date' => 'nullable|date',
        ]);


        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'تم تعديل بيانات المعلم');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'تم حذف المعلم');
    }
}

