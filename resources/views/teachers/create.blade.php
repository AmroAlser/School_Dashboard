@extends('layouts.app')

@section('title', 'إضافة معلم جديد')
@section('page-title', 'معلم جديد')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-plus me-2"></i>استمارة تسجيل معلم جديد
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('teachers.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name') }}" required
                                   placeholder="الاسم الثلاثي للمعلم">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="job_number" class="form-label">الرقم الوظيفي</label>
                        <input type="text" class="form-control" name="job_number" id="job_number" value="{{ old('job_number', $teacher->job_number ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="national_id" class="form-label">رقم الهوية الوطنية <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input type="text" class="form-control @error('national_id') is-invalid @enderror"
                                   id="national_id" name="national_id"
                                   value="{{ old('national_id') }}" required
                                   placeholder="أدخل رقم الهوية الوطنية">
                            @error('national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="specialization" class="form-label">التخصص <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-graduation-cap"></i>
                            </span>
                            <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                                   id="specialization" name="specialization"
                                   value="{{ old('specialization') }}" required
                                   placeholder="تخصص المعلم">
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="subject_id" class="form-label">المادة الدراسية <span class="text-danger">*</span></label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            <option value="" disabled selected>اختر المادة الدراسية</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tasks" class="form-label">المهام</label>
                        <textarea class="form-control" name="tasks" id="tasks" rows="3">{{ old('tasks', $teacher->tasks ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="task_date" class="form-label">تاريخ المهمة</label>
                        <input type="date" class="form-control" name="task_date" id="task_date" value="{{ old('task_date', isset($teacher->task_date) ? $teacher->task_date->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> حفظ البيانات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 1.25rem 1.5rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .input-group-text {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .form-control, .form-select {
        border-radius: 0 0.25rem 0.25rem 0;
        padding: 0.5rem 0.75rem;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.85rem;
    }

    .text-danger {
        color: #dc3545;
    }

    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }
</style>
@endpush
