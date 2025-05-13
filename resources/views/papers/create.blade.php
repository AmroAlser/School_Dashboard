@extends('layouts.app')

@section('title', 'إضافة ورقة جديدة')
@section('page-title', 'إضافة ورقة جديدة')
@section('title-icon', 'fas fa-plus-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-violet text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> إضافة ورقة جديدة
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('papers.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required
                                       placeholder="أدخل عنوان الورقة">
                                <label for="title">عنوان الورقة</label>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="file" class="form-label">رفع الملف</label>
                            <div class="file-upload-card border rounded p-3 text-center @error('file') is-invalid @enderror">
                                <input type="file" name="file" id="file" class="d-none" required>
                                <div class="file-upload-placeholder" onclick="document.getElementById('file').click()">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-violet mb-3"></i>
                                    <h5 class="mb-2">اسحب وأسقط الملف هنا أو انقر للاختيار</h5>
                                    <p class="text-muted mb-0">الحد الأقصى لحجم الملف: 10MB</p>
                                    <p class="text-muted">الامتدادات المسموحة: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX</p>
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
                            <a href="{{ route('papers.index') }}" class="btn btn-outline-violet">
                                <i class="fas fa-arrow-left me-2"></i> رجوع
                            </a>
                            <button type="submit" class="btn btn-violet">
                                <i class="fas fa-save me-2"></i> حفظ الورقة
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

@push('styles')
<style>
    .file-upload-card {
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .file-upload-card:hover {
        background-color: #f0f0f0;
    }

    .file-upload-card.is-invalid {
        border-color: #dc3545;
    }

    .form-floating label {
        right: auto !important;
        left: 0;
        padding: 1rem 0.75rem;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        opacity: 0.8;
    }
</style>
@endpush
