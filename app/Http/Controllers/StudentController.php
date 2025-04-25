<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;


class StudentController extends Controller
{
    public function index(Request $request)
    {
    $query = Student::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%$search%")
              ->orWhere('national_id', 'like', "%$search%");
    }

    $students = $query->oldest()->paginate(10);

    return view('students.index', compact('students'));
    }


    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|unique:students',
            'name' => 'required',
            'gender' => 'required|in:ذكر,أنثى',
            'birth_date' => 'required|date',
            'grade' => 'required',
            'entry_date' => 'required|date',
            'status' => 'required|in:مواطن,لاجئ',
            'academic_year' => 'required|string',
            'transferred_from' => 'nullable|string',
            'transferred_to' => 'nullable|string',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'تم إضافة الطالب بنجاح');
    }
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
{
    $request->validate([
        'national_id' => 'required|unique:students,national_id,' . $student->id,
        'name' => 'required',
        'gender' => 'required|in:ذكر,أنثى',
        'birth_date' => 'required|date',
        'grade' => 'required',
        'entry_date' => 'required|date',
        'status' => 'required|in:مواطن,لاجئ',
        'academic_year' => 'required|string',
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
    public function exportExcel()
    {

        return Excel::download(new StudentsExport, 'students.xlsx');

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
