@extends('layouts.app')

@section('title', 'بيانات المعلم')
@section('page-title', 'تفاصيل المعلم')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-chalkboard-teacher me-2"></i>الملف الشخصي للمعلم: {{ $teacher->name }}
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- العمود الأول -->
                <div class="col-md-6">
                    <div class="teacher-detail-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-id-card"></i> المعلومات الشخصية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">رقم الهوية:</span>
                                <span class="detail-value">{{ $teacher->national_id }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">التخصص:</span>
                                <span class="detail-value">{{ $teacher->specialization }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- العمود الثاني -->
                <div class="col-md-6">
                    <div class="teacher-detail-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-book"></i> المعلومات الأكاديمية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">المادة الدراسية:</span>
                                <span class="detail-value">
                                    @if($teacher->subject)
                                        <span class="badge bg-primary">{{ $teacher->subject->name }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="teacher-actions mt-4">
                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i> تعديل البيانات
                </a>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-1"></i> رجوع للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .teacher-detail-card {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        overflow: hidden;
    }

    .detail-header {
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        border-bottom: 1px solid #dee2e6;
        background-color: rgba(13, 202, 240, 0.1);
    }

    .detail-body {
        padding: 1.25rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed #eee;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #6c757d;
    }

    .detail-value {
        color: #495057;
    }

    .teacher-actions {
        display: flex;
        justify-content: flex-end;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }

    .bg-info-light {
        background-color: rgba(13, 202, 240, 0.1);
    }

    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.25rem;
        font-weight: 500;
    }
</style>
@endpush
