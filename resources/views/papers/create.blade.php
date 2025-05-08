@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">
            <i class="fas fa-plus-circle"></i> إضافة ورقة جديدة
        </h1>
        <a href="{{ route('papers.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> رجوع للقائمة
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-file-upload"></i> بيانات الورقة الجديدة
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('papers.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title" class="font-weight-bold">
                        <i class="fas fa-heading"></i> عنوان الورقة
                    </label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file" class="font-weight-bold">
                        <i class="fas fa-file"></i> رفع الملف
                    </label>
                    <div class="custom-file">
                        <input type="file" name="file" id="file" class="custom-file-input @error('file') is-invalid @enderror" required>
                        <label class="custom-file-label" for="file">اختر ملف (PDF, Word, Excel, PPT)</label>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">الحجم الأقصى للملف: 10MB</small>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> حفظ الورقة
                    </button>
                    <button type="reset" class="btn btn-outline-secondary mx-2">
                        <i class="fas fa-undo"></i> إعادة تعيين
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // لعرض اسم الملف عند اختياره
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("file").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection
