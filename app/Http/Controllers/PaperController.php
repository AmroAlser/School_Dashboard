<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaperController extends Controller
{
    // عرض جميع الأوراق
    public function index()
    {
        $papers = Paper::paginate(10);
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
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        $title = $request->input('title');
        $uploadedFile = $request->file('file');
        $extension = $uploadedFile->getClientOriginalExtension();

        // توليد اسم فريد لتفادي التكرار
        $fileName = Str::slug($title) . '-' . time() . '.' . $extension;

        // حفظ الملف في مجلد papers داخل public
        $path = $uploadedFile->storeAs('papers', $fileName, 'public');

        $paper = new Paper();
        $paper->title = $title;
        $paper->file = $path;
        $paper->save();

        return redirect()->route('papers.index')->with('success', 'تم إضافة الورقة بنجاح!');
    }

    // عرض ورقة مفردة
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
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        $paper->title = $request->title;

        if ($request->hasFile('file')) {
            // حذف الملف القديم إن وُجد
            if (Storage::disk('public')->exists($paper->file)) {
                Storage::disk('public')->delete($paper->file);
            }

            $uploadedFile = $request->file('file');
            $extension = $uploadedFile->getClientOriginalExtension();
            $fileName = Str::slug($request->title) . '-' . time() . '.' . $extension;
            $filePath = $uploadedFile->storeAs('papers', $fileName, 'public');

            $paper->file = $filePath;
        }

        $paper->save();

        return redirect()->route('papers.index')->with('success', 'تم تعديل الورقة بنجاح');
    }

    // حذف ورقة
    public function destroy(Paper $paper)
    {
        if (Storage::disk('public')->exists($paper->file)) {
            Storage::disk('public')->delete($paper->file);
        }

        $paper->delete();

        return redirect()->route('papers.index')->with('success', 'تم حذف الورقة بنجاح');
    }

    // تنزيل الورقة
    public function download(Paper $paper)
{
    // تحديد المسار للملف
    $path = storage_path('app/public/' . $paper->file);

    // التأكد من وجود الملف
    if (!file_exists($path)) {
        abort(404, 'الملف غير موجود.');
    }

    // الحصول على امتداد الملف
    $extension = pathinfo($paper->file, PATHINFO_EXTENSION);

    // توليد اسم الملف بناءً على العنوان مع الامتداد
    $downloadName = Str::slug($paper->title) . '.' . $extension;

    // استجابة تنزيل الملف
    return response()->download($path, $downloadName);
}

}
