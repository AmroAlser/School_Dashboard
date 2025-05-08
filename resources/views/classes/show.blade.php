@extends('layouts.app')

@section('title', 'تفاصيل الصف')
@section('page-title', 'تفاصيل الصف')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-school me-2"></i>الملف التفصيلي للصف: {{ $class->name }}
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="subject-details-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">اسم الصف:</span>
                                <span class="detail-value">{{ $class->name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">عدد الطلاب:</span>
                                <span class="badge bg-primary">{{ $class->students_count ?? $class->students->count() }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">تاريخ الإنشاء:</span>
                                <span class="detail-value">{{ $class->created_at->format('Y/m/d') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($class->students->count() > 0)
                    <div class="subject-details-card">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-users me-2"></i> الطلاب في هذا الصف
                        </div>
                        <div class="detail-body">
                            <ul class="list-group list-group-flush">
                                @foreach($class->students as $student)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-user text-muted me-2"></i>
                                            {{ $student->name }}
                                        </div>
                                        <span class="badge bg-secondary">{{ $student->gender }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> تعديل
                </a>
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-1"></i> رجوع للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .subject-details-card {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .detail-header {
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        background-color: rgba(13, 202, 240, 0.1);
        border-bottom: 1px solid #dee2e6;
    }

    .detail-body {
        padding: 1.25rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
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

    .bg-info-light {
        background-color: rgba(13, 202, 240, 0.1);
    }

    .list-group-item {
        border-left: none;
        border-right: none;
    }
</style>
@endpush
