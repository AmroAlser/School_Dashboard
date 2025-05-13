@extends('layouts.app')

@section('title', 'تفاصيل التقييم')
@section('page-title', 'تفاصيل التقييم')
@section('title-icon', 'fas fa-info-circle')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-violet text-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i> تفاصيل التقييم
                    </h5>
                </div>
                <div class="card-body">
                    <div class="evaluation-details">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="detail-card">
                                    <div class="detail-icon bg-violet-light">
                                        <i class="fas fa-chalkboard-teacher text-violet"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6 class="text-muted">المعلم</h6>
                                        <h5 class="mb-0">{{ $evaluation->teacher->name }}</h5>
                                        <small class="text-muted">{{ $evaluation->teacher->subject }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-card">
                                    <div class="detail-icon bg-indigo-light">
                                        <i class="fas fa-user-graduate text-indigo"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6 class="text-muted">الطالب</h6>
                                        <h5 class="mb-0">{{ $evaluation->student->name }}</h5>
                                        <small class="text-muted">{{ $evaluation->student->class->name }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-card">
                                    <div class="detail-icon bg-primary-light">
                                        <i class="fas fa-school text-primary"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6 class="text-muted">الصف</h6>
                                        <h5 class="mb-0">{{ $evaluation->class->name }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-card">
                                    <div class="detail-icon bg-success-light">
                                        <i class="fas fa-user-tie text-success"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6 class="text-muted">المقيم</h6>
                                        <h5 class="mb-0">{{ $evaluation->evaluator_name }}</h5>
                                        <small class="text-muted">{{ $evaluation->evaluator_job_number }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-card">
                                    <div class="detail-icon bg-warning-light">
                                        <i class="fas fa-calendar-alt text-warning"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6 class="text-muted">تاريخ التقييم</h6>
                                        <h5 class="mb-0">{{ $evaluation->evaluation_date->format('Y/m/d') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="evaluation-content p-4 bg-light rounded-3 border-start border-4 border-violet">
                            <h5 class="mb-3 text-violet">
                                <i class="fas fa-file-alt me-2"></i> نص التقييم
                            </h5>
                            <div class="evaluation-text p-3 bg-white rounded-2">
                                {{ $evaluation->evaluation }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('evaluations.index') }}" class="btn btn-outline-violet">
                                <i class="fas fa-arrow-left me-1"></i> رجوع للقائمة
                            </a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-violet">
                                    <i class="fas fa-edit me-1"></i> تعديل
                                </a>
                                <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST">
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
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .detail-card {
        display: flex;
        align-items: center;
        padding: 1rem;
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        height: 100%;
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
        margin-bottom: 0.25rem;
        font-size: 0.85rem;
    }

    .detail-content h5 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .evaluation-content {
        background-color: #f8f9fa;
    }

    .evaluation-text {
        white-space: pre-line;
        line-height: 1.8;
    }

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }

    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }

    .bg-indigo-light {
        background-color: rgba(102, 16, 242, 0.1);
    }
</style>
@endpush
