@extends('layouts.app')

@section('title', 'قائمة الدورات')
@section('page-title', 'إدارة الدورات')
@section('title-icon', 'fas fa-certificate')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6f42c1, #4e2a8e);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-certificate me-2"></i> نظام إدارة الدورات التدريبية
                        </h4>
                        <p class="mb-0 text-white-50">
                            هنا يمكنك إدارة جميع الدورات التدريبية في المؤسسة التعليمية
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-chalkboard-teacher text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions & Filters -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="d-flex gap-2">
                <a href="{{ route('courses.create') }}" class="btn btn-purple shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i> إضافة دورة جديدة
                </a>
                <button class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i> تصفية النتائج
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="ابحث عن دورة...">
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2 fs-4"></i>
            <div>
                <h6 class="mb-0">تم بنجاح!</h6>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Courses Cards -->
    <div class="row">
        @forelse($courses as $course)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card course-card shadow-sm h-100 border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom-0">
                    <h5 class="mb-0 text-purple">{{ $course->title }}</h5>
                    <td class="text-end">
                        @php
                            $endDate = \Carbon\Carbon::parse($course->end_date);
                            $isActive = $endDate->isFuture(); // true لو التاريخ بعد اليوم
                        @endphp
                        <span class="badge bg-{{ $isActive ? 'success' : 'secondary' }}">
                            {{ $isActive ? 'نشطة' : 'منتهية' }}
                        </span>
                        <div style="font-size: 0.8em; color: #888;">
                            {{ $endDate->format('Y-m-d') }}
                        </div>
                    </td>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm me-3">
                            <span class="avatar-title bg-purple-light rounded-circle">
                                <i class="fas fa-chalkboard-teacher text-purple"></i>
                            </span>
                        </div>
                        <div>
                            <h6 class="mb-0">المدرب</h6>
                            <p class="mb-0 text-muted">{{ $course->instructor }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="mb-0">عدد المشاركين</h6>
                            <p class="mb-0 text-muted">{{ $course->participants }}</p>
                        </div>
                        <div>
                            <h6 class="mb-0">المدة</h6>
                            <p class="mb-0 text-muted">
                                {{ $course->start_date}} -
                                {{ $course->end_date }}
                            </p>
                        </div>
                    </div>

                    <div class="progress mb-3" style="height: 8px;">
                        @php
                            $progress = $course->progress();
                        @endphp
                        <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $progress }}%"
                             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted d-flex justify-content-between">
                        <span>تقدم الدورة</span>
                        <span>{{ $progress }}% مكتمل</span>
                    </small>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-purple">
                            <i class="fas fa-eye me-1"></i> التفاصيل
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}">
                                        <i class="fas fa-edit me-2"></i> تعديل
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('هل أنت متأكد من حذف هذه الدورة؟')">
                                            <i class="fas fa-trash me-2"></i> حذف
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-certificate fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">لا توجد دورات مسجلة</h4>
                    <p class="text-muted mb-4">يمكنك بدء إضافة دورات جديدة بالنقر على زر "إضافة دورة جديدة"</p>
                    <a href="{{ route('courses.create') }}" class="btn btn-purple">
                        <i class="fas fa-plus-circle me-2"></i> إضافة دورة جديدة
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($courses->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
    @endif
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-purple text-white">
                <h5 class="modal-title" id="filterModalLabel">
                    <i class="fas fa-filter me-2"></i> تصفية الدورات
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="statusFilter" class="form-label">حالة الدورة</label>
                        <select id="statusFilter" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="active">نشطة</option>
                            <option value="finished">منتهية</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="instructorFilter" class="form-label">اسم المدرب</label>
                        <input type="text" id="instructorFilter" class="form-control" placeholder="ابحث باسم المدرب">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDateFilter" class="form-label">من تاريخ</label>
                            <input type="date" id="startDateFilter" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="endDateFilter" class="form-label">إلى تاريخ</label>
                            <input type="date" id="endDateFilter" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-purple">تطبيق التصفية</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .course-card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 1px solid rgba(111, 66, 193, 0.1);
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.1);
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .bg-purple-light {
        background-color: rgba(111, 66, 193, 0.1);
    }

    .text-purple {
        color: #6f42c1 !important;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: white;
        border-color: #6f42c1;
    }

    .btn-purple:hover {
        background-color: #5e32a8;
        border-color: #5e32a8;
        color: white;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }

    .avatar-sm {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 1rem;
    }

    .progress {
        border-radius: 50px;
    }

    .progress-bar {
        border-radius: 50px;
    }

    .welcome-card .card {
        border-radius: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Course card hover effect
    $('.course-card').hover(
        function() {
            $(this).addClass('shadow');
        },
        function() {
            $(this).removeClass('shadow');
        }
    );
});
</script>
@endpush
