@extends('layouts.app')

@section('title', 'إضافة تقييم جديد')
@section('page-title', 'تقييم جديد')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>إضافة تقييم جديد
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('evaluations.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="teacher_id" class="form-label">المعلم</label>
                        <select name="teacher_id" id="teacher_id" class="form-select select2" required>
                            <option value="">اختر معلم...</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="student_id" class="form-label">الطالب</label>
                        <select name="student_id" id="student_id" class="form-select select2" required>
                            <option value="">اختر طالب...</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="evaluator_name" class="form-label">اسم المقيم</label>
                        <input type="text" name="evaluator_name" id="evaluator_name" class="form-control" value="{{ old('evaluator_name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="evaluator_job_number" class="form-label">الرقم الوظيفي للمقيم</label>
                        <input type="text" name="evaluator_job_number" id="evaluator_job_number" class="form-control" value="{{ old('evaluator_job_number') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="evaluation_date" class="form-label">تاريخ التقييم</label>
                        <input type="date" name="evaluation_date" id="evaluation_date" class="form-control" value="{{ old('evaluation_date') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="evaluation" class="form-label">نص التقييم</label>
                    <textarea name="evaluation" id="evaluation" class="form-control" rows="6" required>{{ old('evaluation') }}</textarea>
                    <div class="form-text">يجب أن يحتوي التقييم على ملاحظات واضحة ودقيقة حول أداء الطالب</div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> حفظ التقييم
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'اختر من القائمة',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush

@push('styles')
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    .form-text {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .card {
        border-radius: 0.5rem;
    }
</style>
@endpush
