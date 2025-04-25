@extends('layouts.app')

@section('title', 'تعديل بيانات المعلم')
@section('page-title', 'تعديل بيانات المعلم')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-edit me-2"></i>تعديل بيانات المعلم: {{ $teacher->name }}
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-white">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name', $teacher->name) }}" required
                                   placeholder="الاسم الثلاثي للمعلم">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="national_id" class="form-label">رقم الهوية الوطنية <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-white">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input type="text" class="form-control @error('national_id') is-invalid @enderror"
                                   id="national_id" name="national_id"
                                   value="{{ old('national_id', $teacher->national_id) }}" required
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
                            <span class="input-group-text bg-warning text-white">
                                <i class="fas fa-graduation-cap"></i>
                            </span>
                            <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                                   id="specialization" name="specialization"
                                   value="{{ old('specialization', $teacher->specialization) }}" required
                                   placeholder="تخصص المعلم">
                            @error('specialization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="subject_id" class="form-label">المادة الدراسية <span class="text-danger">*</span></label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            <option value="" disabled>اختر المادة الدراسية</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $teacher->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-sync-alt me-1"></i> تحديث البيانات
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
