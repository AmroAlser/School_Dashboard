@extends('layouts.app')

@section('title', 'بيانات الطالب')
@section('page-title', 'تفاصيل الطالب')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="fas fa-user-graduate me-2"></i>الملف الشخصي للطالب: <span class="fw-bold me-2">{{ $student->name }}</span>
            </h5>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <!-- العمود الأول -->
                <div class="col-lg-6">
                    <div class="student-detail-card mb-4 border-0 shadow-sm">
                        <div class="detail-header bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-id-card me-2"></i> المعلومات الشخصية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">رقم الهوية:</span>
                                <span class="detail-value fw-medium">{{ $student->national_id }}</span>
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
                                <span class="badge {{ $student->status == 'مواطن' ? 'bg-success' : 'bg-warning' }} rounded-pill px-3 py-1">
                                    {{ $student->status }}
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">الإعاقة:</span>
                                <span class="detail-value">{{ $student->disability ?? 'لا يوجد' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="student-detail-card mb-4 border-0 shadow-sm">
                        <div class="detail-header bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-home me-2"></i> معلومات السكن
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
                <div class="col-lg-6">
                    <div class="student-detail-card mb-4 border-0 shadow-sm">
                        <div class="detail-header bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-school me-2"></i> المعلومات الأكاديمية
                        </div>
                        <div class="detail-body">
                            <div class="detail-item">
                                <span class="detail-label">الصف الدراسي:</span>
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

                    @if($student->report_image)
                    <div class="student-detail-card mb-4 border-0 shadow-sm">
                        <div class="detail-header bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-file-alt me-2"></i> تقرير الطالب
                        </div>
                        <div class="detail-body">
                            <div class="text-center">
                                <div class="report-image-frame mx-auto mb-3">
                                    <img src="{{ asset($student->report_image) }}"
                                         alt="صورة تقرير الطالب"
                                         class="report-image img-thumbnail"
                                         data-bs-toggle="modal"
                                         data-bs-target="#reportImageModal">
                                </div>
                                <a href="{{ asset($student->report_image) }}"
                                   class="btn btn-primary btn-sm rounded-pill px-3"
                                   download="تقرير_الطالب_{{ $student->name }}">
                                    <i class="fas fa-download me-1"></i> تحميل التقرير
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="student-actions bg-light p-3 rounded-2 mt-3">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning rounded-pill px-3 me-2">
                            <i class="fas fa-edit me-1"></i> تعديل البيانات
                        </a>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary rounded-pill px-3">
                            <i class="fas fa-list me-1"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for enlarged report image -->
@if($student->report_image)
<div class="modal fade" id="reportImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">تقرير الطالب: {{ $student->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center bg-light">
                <img src="{{ asset($student->report_image) }}"
                     alt="صورة تقرير الطالب"
                     class="img-fluid p-3">
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <a href="{{ asset($student->report_image) }}"
                   class="btn btn-primary rounded-pill px-4"
                   download="تقرير_الطالب_{{ $student->name }}">
                    <i class="fas fa-download me-1"></i> تحميل التقرير
                </a>
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> إغلاق
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .student-detail-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }

    .student-detail-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .detail-header {
        padding: 12px 20px;
        font-weight: 600;
        font-size: 1.05rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .detail-body {
        padding: 20px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.08);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 500;
        color: #6c757d;
        min-width: 120px;
    }

    .detail-value {
        color: #495057;
        font-weight: 400;
        text-align: left;
    }

    .student-actions {
        display: flex;
        justify-content: flex-end;
        background-color: rgba(248, 249, 250, 0.7) !important;
        backdrop-filter: blur(5px);
    }

    /* Report image styling */
    .report-image-frame {
        width: 100%;
        max-width: 350px;
        padding: 12px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .report-image {
        max-height: 280px;
        width: auto;
        max-width: 100%;
        border-radius: 6px !important;
        object-fit: contain;
        cursor: zoom-in;
        transition: transform 0.3s ease;
    }

    .report-image:hover {
        transform: scale(1.02);
    }

    .report-image-frame:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    /* Modal styling */
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-body img {
        max-height: 65vh;
        width: auto;
        max-width: 100%;
        object-fit: contain;
    }

    /* Buttons styling */
    .btn {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn:active {
        transform: translateY(0);
    }
</style>
@endpush

@push('scripts')
@if($student->report_image)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reportImageModal = new bootstrap.Modal(document.getElementById('reportImageModal'));
    });
</script>
@endif
@endpush
