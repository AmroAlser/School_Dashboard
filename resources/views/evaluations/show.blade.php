@extends('layouts.app')

@section('title', 'تفاصيل التقييم')
@section('page-title', 'تفاصيل التقييم')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>تفاصيل التقييم
            </h5>
        </div>

        <div class="card-body">
            <div class="evaluation-details">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-icon bg-primary-light">
                                <i class="fas fa-chalkboard-teacher text-primary"></i>
                            </div>
                            <div class="detail-content">
                                <h6>المعلم</h6>
                                <p>{{ $evaluation->teacher->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-icon bg-info-light">
                                <i class="fas fa-user-graduate text-info"></i>
                            </div>
                            <div class="detail-content">
                                <h6>الطالب</h6>
                                <p>{{ $evaluation->student->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="detail-card">
                            <div class="detail-icon bg-success-light">
                                <i class="fas fa-user-tie text-success"></i>
                            </div>
                            <div class="detail-content">
                                <h6>اسم المقيم</h6>
                                <p>{{ $evaluation->evaluator_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="detail-card">
                            <div class="detail-icon bg-dark-light">
                                <i class="fas fa-id-badge text-dark"></i>
                            </div>
                            <div class="detail-content">
                                <h6>الرقم الوظيفي للمقيم</h6>
                                <p>{{ $evaluation->evaluator_job_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="detail-card">
                            <div class="detail-icon bg-warning-light">
                                <i class="fas fa-calendar-alt text-warning"></i>
                            </div>
                            <div class="detail-content">
                                <h6>تاريخ التقييم</h6>
                                <p>{{ $evaluation->evaluation_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="evaluation-content p-4 bg-light rounded">
                    <h5 class="mb-3 text-primary">نص التقييم:</h5>
                    <div class="evaluation-text">{{ $evaluation->evaluation }}</div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> رجوع
                    </a>
                    <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i> تعديل
                    </a>
                    <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا التقييم؟')">
                            <i class="fas fa-trash-alt me-1"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .evaluation-details {
        font-size: 1.05rem;
    }

    .detail-card {
        display: flex;
        align-items: center;
        padding: 1rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .detail-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-left: 1rem;
    }

    .detail-content h6 {
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .detail-content p {
        margin-bottom: 0;
        font-weight: 500;
    }

    .evaluation-content {
        border-left: 4px solid #4e73df;
    }

    .evaluation-text {
        white-space: pre-line;
        line-height: 1.8;
    }
</style>
@endpush
