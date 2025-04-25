<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // الاستعلام الأساسي للحصول على جميع المواد مع عدد المعلمين
        $query = Subject::withCount('teachers')->oldest();

        // إذا تم اختيار مادة معينة
        if ($request->subject) {
            $query->where('id', $request->subject);
        }

        $subjects = $query->paginate(10);

        return view('subjects.index', compact('subjects'));
    }



    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'تمت إضافة المادة بنجاح');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'تم تحديث المادة بنجاح');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'تم حذف المادة');
    }
}
