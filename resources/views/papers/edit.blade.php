@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">
            <i class="fas fa-edit"></i> تعديل الورقة
        </h1>
        <a href="{{ route('papers.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> رجوع للقائمة
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-file-edit"></i> تحديث بيانات الورقة
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('papers.update', $paper->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="font-weight-bold">
                        <i class="fas fa-heading"></i> عنوان الورقة
                    </label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $paper->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">
                        <i class="fas fa-file"></i> الملف الحالي
                    </label>
                    <div class="mb-3">
                        <a href="{{ asset('storage/' . $paper->file) }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> معاينة الملف الحالي
                        </a>
                    </div>

                    <label for="file" class="font-weight-bold">
                        <i class="fas fa-sync-alt"></i> استبدال الملف (اختياري)
                    </label>
                    <div class="custom-file">
                        <input type="file" name="file" id="file" class="custom-file-input @error('file') is-invalid @enderror">
                        <label class="custom-file-label" for="file">اختر ملف جديد</label>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">الحجم الأقصى للملف: 10MB</small>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="fas fa-sync-alt"></i> تحديث الورقة
                    </button>
                    <a href="{{ route('papers.show', $paper->id) }}" class="btn btn-outline-secondary mx-2">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // لعرض اسم الملف عند اختياره
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("file").files[0]?.name || 'اختر ملف جديد';
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection
