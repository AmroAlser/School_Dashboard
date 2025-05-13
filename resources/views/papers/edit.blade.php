@extends('layouts.app')

@section('title', 'تعديل الورقة')
@section('page-title', 'تعديل الورقة')
@section('title-icon', 'fas fa-edit')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-violet text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> تعديل الورقة: {{ $paper->title }}
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('papers.update', $paper->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title', $paper->title) }}" required
                                       placeholder="أدخل عنوان الورقة">
                                <label for="title">عنوان الورقة</label>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">الملف الحالي</label>
                            <div class="current-file-card border rounded p-3 mb-3">
                                @php
                                    $extension = pathinfo($paper->file, PATHINFO_EXTENSION);
                                    $icon = [
                                        'pdf' => 'file-pdf',
                                        'doc' => 'file-word',
                                        'docx' => 'file-word',
                                        'xls' => 'file-excel',
                                        'xlsx' => 'file-excel',
                                        'ppt' => 'file-powerpoint',
                                        'pptx' => 'file-powerpoint'
                                    ][$extension] ?? 'file-alt';
                                @endphp
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-{{ $icon }} fa-2x text-violet"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $paper->title }}.{{ $extension }}</h6>
                                        <a href="{{ route('papers.download', $paper->id) }}" class="btn btn-sm btn-outline-violet">
                                            <i class="fas fa-download me-1"></i> تنزيل
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <label for="file" class="form-label">استبدال الملف (اختياري)</label>
                            <div class="file-upload-card border rounded p-3 text-center @error('file') is-invalid @enderror">
                                <input type="file" name="file" id="file" class="d-none">
                                <div class="file-upload-placeholder" onclick="document.getElementById('file').click()">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-violet mb-3"></i>
                                    <h5 class="mb-2">اسحب وأسقط الملف هنا أو انقر للاختيار</h5>
                                    <p class="text-muted mb-0">الحد الأقصى لحجم الملف: 10MB</p>
                                </div>
                                <div class="file-upload-preview d-none">
                                    <i class="fas fa-file-alt fa-3x text-violet mb-3"></i>
                                    <h5 class="file-name mb-2"></h5>
                                    <p class="file-size text-muted mb-3"></p>
                                    <button type="button" class="btn btn-sm btn-outline-violet change-file">
                                        <i class="fas fa-sync-alt me-1"></i> تغيير الملف
                                    </button>
                                </div>
                                @error('file')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('papers.show', $paper->id) }}" class="btn btn-outline-violet">
                                <i class="fas fa-times me-2"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-violet">
                                <i class="fas fa-sync-alt me-2"></i> تحديث الورقة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // File upload preview
    const fileInput = document.getElementById('file');
    const placeholder = document.querySelector('.file-upload-placeholder');
    const preview = document.querySelector('.file-upload-preview');
    const fileName = document.querySelector('.file-name');
    const fileSize = document.querySelector('.file-size');

    fileInput.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const file = this.files[0];
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

            fileName.textContent = file.name;
            fileSize.textContent = `${fileSizeMB} MB`;

            placeholder.classList.add('d-none');
            preview.classList.remove('d-none');
        }
    });

    document.querySelector('.change-file').addEventListener('click', function() {
        fileInput.value = '';
        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');
    });
});
</script>
@endpush
