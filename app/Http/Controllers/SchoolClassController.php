<?php

// app/Http/Controllers/SchoolClassController.php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        SchoolClass::create($request->all());

        return redirect()->route('classes.index')->with('success', 'تم إنشاء الصف بنجاح.');
    }
    public function show($id)
    {
        // جلب الصف بواسطة المعرف (ID)
        $class = SchoolClass::findOrFail($id);

        // إرجاع العرض مع البيانات
        return view('classes.show', compact('class'));
    }

    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'تم تعديل الصف بنجاح.');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'تم حذف الصف بنجاح.');
    }
}
