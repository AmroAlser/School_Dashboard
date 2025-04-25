@extends('layouts.app')

@section('title', 'تعديل التقييم')
@section('page-title', 'تعديل التقييم')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>تعديل التقييم
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('evaluations.update', $evaluation) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="teacher_id" class="form-label">المعلم</label>
                        <select name="teacher_id" id="teacher_id" class="form-select select2" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $evaluation->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="student_id" class="form-label">الطالب</label>
                        <select name="student_id" id="student_id" class="form-select select2" required>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ $evaluation->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="evaluator_name" class="form-label">اسم المقيم</label>
                        <input type="text" name="evaluator_name" id="evaluator_name" class="form-control" value="{{ $evaluation->evaluator_name }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="evaluator_job_number" class="form-label">الرقم الوظيفي للمقيم</label>
                        <input type="text" name="evaluator_job_number" id="evaluator_job_number" class="form-control" value="{{ $evaluation->evaluator_job_number }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="evaluation_date" class="form-label">تاريخ التقييم</label>
                            <input type="date" name="evaluation_date" id="evaluation_date" class="form-control" value="{{ $evaluation->evaluation_date->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="evaluation" class="form-label">نص التقييم</label>
                    <textarea name="evaluation" id="evaluation" class="form-control" rows="6" required>{{ $evaluation->evaluation }}</textarea>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-outline-secondary me-2">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });
</script>
@endpush
