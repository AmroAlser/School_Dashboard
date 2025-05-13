@extends('layouts.app')

@section('title', 'إضافة تقييم جديد')
@section('page-title', 'إضافة تقييم جديد')
@section('title-icon', 'fas fa-plus-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-violet text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i> إضافة تقييم جديد
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluations.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="teacher_id" id="teacher_id" class="form-select select2 @error('teacher_id') is-invalid @enderror" required>
                                        <option value=""></option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name  }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="teacher_id">المعلم</label>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="student_id" id="student_id" class="form-select select2 @error('student_id') is-invalid @enderror" required>
                                        <option value=""></option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }} - {{ $student->class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="student_id">الطالب</label>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="class_id" id="class_id" class="form-select select2 @error('class_id') is-invalid @enderror" required>
                                        <option value=""></option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="class_id">الصف</label>
                                    @error('class_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="evaluation_date" id="evaluation_date"
                                           class="form-control @error('evaluation_date') is-invalid @enderror"
                                           value="{{ old('evaluation_date') }}" required>
                                    <label for="evaluation_date">تاريخ التقييم</label>
                                    @error('evaluation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="evaluator_name" id="evaluator_name"
                                           class="form-control @error('evaluator_name') is-invalid @enderror"
                                           value="{{ old('evaluator_name') }}" required>
                                    <label for="evaluator_name">اسم المقيم</label>
                                    @error('evaluator_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="evaluator_job_number" id="evaluator_job_number"
                                           class="form-control @error('evaluator_job_number') is-invalid @enderror"
                                           value="{{ old('evaluator_job_number') }}" required>
                                    <label for="evaluator_job_number">الرقم الوظيفي للمقيم</label>
                                    @error('evaluator_job_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea name="evaluation" id="evaluation"
                                          class="form-control @error('evaluation') is-invalid @enderror"
                                          style="height: 150px" required>{{ old('evaluation') }}</textarea>
                                <label for="evaluation">نص التقييم</label>
                                @error('evaluation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-muted mt-1">
                                <i class="fas fa-info-circle me-1"></i> أدخل ملاحظات واضحة ودقيقة حول أداء الطالب
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('evaluations.index') }}" class="btn btn-outline-violet">
                                <i class="fas fa-times me-1"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-violet">
                                <i class="fas fa-save me-1"></i> حفظ التقييم
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
    // Initialize Select2
    $('.select2').select2({
        placeholder: 'اختر من القائمة',
        allowClear: true,
        width: '100%',
        dropdownParent: $('.card-body')
    });

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
});
</script>
@endpush

@push('styles')
<style>
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

    .select2-container--default .select2-selection--single {
        height: calc(3.5rem + 2px);
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 3.5rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 3.5rem;
    }

    .form-text {
        font-size: 0.85rem;
    }
</style>
@endpush
