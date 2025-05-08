<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;

class PaperController extends Controller
{
    // عرض جميع الأوراق
    public function index()
    {
        $papers = Paper::paginate(10); // استخدم paginate بدل all
        return view('papers.index', compact('papers'));
    }

    // عرض صفحة إضافة ورقة
    public function create()
    {
        return view('papers.create');
    }

    // تخزين الورقة في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);

        $filePath = $request->file('file')->store('papers', 'public');

        Paper::create([
            'title' => $request->title,
            'file' => $filePath,
        ]);

        return redirect()->route('papers.index')->with('success', 'تمت إضافة الورقة بنجاح');
    }
    // عرض ورقة مفردة (show)
    public function show(Paper $paper)
    {
    return view('papers.show', compact('paper'));
    }

    // عرض صفحة تعديل ورقة
    public function edit(Paper $paper)
    {
        return view('papers.edit', compact('paper'));
    }

    // تحديث الورقة
    public function update(Request $request, Paper $paper)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            // حذف الملف القديم
            Storage::delete('public/' . $paper->file);

            // تخزين الملف الجديد
            $filePath = $request->file('file')->store('papers', 'public');
            $paper->file = $filePath;
        }

        $paper->title = $request->title;
        $paper->save();

        return redirect()->route('papers.index')->with('success', 'تم تعديل الورقة بنجاح');
    }

    // حذف ورقة
    public function destroy(Paper $paper)
    {
        Storage::delete('public/' . $paper->file);
        $paper->delete();

        return redirect()->route('papers.index')->with('success', 'تم حذف الورقة بنجاح');
    }
}
