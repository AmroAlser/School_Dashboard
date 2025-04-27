@extends('layouts.app')

@section('title', 'بيانات الطالب')
@section('page-title', 'تفاصيل الطالب')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-graduate me-2"></i>الملف الشخصي للطالب: {{ $student->name }}
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- العمود الأول -->
                <div class="col-md-6">
                    <div class="student-detail-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-id-card"></i> المعلومات الشخصية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">رقم الهوية:</span>
                                <span class="detail-value">{{ $student->national_id }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">الجنس:</span>
                                <span class="detail-value">{{ $student->gender }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">تاريخ الميلاد:</span>
                                <span class="detail-value">{{ $student->birth_date }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">الحالة:</span>
                                <span class="badge {{ $student->status == 'مواطن' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $student->status }}
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">الإعاقة:</span>
                                <span class="detail-value">{{ $student->disability ?? 'لا يوجد' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="student-detail-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-home"></i> معلومات السكن
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">العنوان:</span>
                                <span class="detail-value">{{ $student->address ?? 'غير محدد' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">رقم الهاتف:</span>
                                <span class="detail-value">{{ $student->phone ?? 'غير محدد' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">رقم هوية الوصي:</span>
                                <span class="detail-value">{{ $student->guardian_national_id ?? 'غير محدد' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- العمود الثاني -->
                <div class="col-md-6">
                    <div class="student-detail-card mb-4">
                        <div class="detail-header bg-info-light">
                            <i class="fas fa-school"></i> المعلومات الأكاديمية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">  الصف الدراسي:</span>
                                <span class="detail-value">{{ $student->class->name ?? 'غير محدد' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">الفصل الدراسي:</span>
                                <span class="detail-value">{{ $student->semester->name ?? 'غير محدد' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">السنة الدراسية:</span>
                                <span class="detail-value">{{ $student->academic_year }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">تاريخ التسجيل:</span>
                                <span class="detail-value">{{ $student->entry_date }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">محول من:</span>
                                <span class="detail-value">{{ $student->transferred_from ?? 'لا يوجد' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">محول إلى:</span>
                                <span class="detail-value">{{ $student->transferred_to ?? 'لا يوجد' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="student-actions mt-4">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i> تعديل البيانات
                        </a>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-1"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .student-detail-card {
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

    .student-actions {
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
