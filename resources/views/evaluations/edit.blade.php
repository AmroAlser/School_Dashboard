@extends('layouts.app')

@section('title', 'تعديل التقييم')
@section('page-title', 'تعديل التقييم')
@section('title-icon', 'fas fa-edit')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i> تعديل التقييم
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluations.update', $evaluation->id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="teacher_id" id="teacher_id" class="form-select select2 @error('teacher_id') is-invalid @enderror" required>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $evaluation->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }} - {{ $teacher->subject }}
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
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}" {{ $evaluation->student_id == $student->id ? 'selected' : '' }}>
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
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $evaluation->class_id == $class->id ? 'selected' : '' }}>
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
                                           value="{{ old('evaluation_date', $evaluation->evaluation_date->format('Y-m-d')) }}" required>
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
                                           value="{{ old('evaluator_name', $evaluation->evaluator_name) }}" required>
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
                                           value="{{ old('evaluator_job_number', $evaluation->evaluator_job_number) }}" required>
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
                                          style="height: 150px" required>{{ old('evaluation', $evaluation->evaluation) }}</textarea>
                                <label for="evaluation">نص التقييم</label>
                                @error('evaluation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> إلغاء
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="fas fa-sync-alt me-1"></i> تحديث التقييم
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
