<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::orderBy('start_date', 'desc')->paginate(10);
        return view('semesters.index', compact('semesters'));
    }

    public function create()
    {
        return view('semesters.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Semester::create($request->all());

        return redirect()->route('semesters.index')
            ->with('success', 'تم إنشاء الفصل الدراسي بنجاح');
    }

    public function show(Semester $semester)
    {
        $classesCount = SchoolClass::count();
        return view('semesters.show', compact('semester','classesCount'));
    }

    public function edit(Semester $semester)
    {
        return view('semesters.edit', compact('semester'));
    }

    public function update(Request $request, Semester $semester)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $semester->update($request->all());

        return redirect()->route('semesters.index')
            ->with('success', 'تم تحديث الفصل الدراسي بنجاح');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('semesters.index')
            ->with('success', 'تم حذف الفصل الدراسي بنجاح');
    }
}
