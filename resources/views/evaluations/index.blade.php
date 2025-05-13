@extends('layouts.app')

@section('title', 'إدارة التقييمات')
@section('page-title', 'قائمة التقييمات')
@section('title-icon', 'fas fa-star-half-alt')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6f42c1, #6610f2);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-star-half-alt me-2"></i> نظام التقييمات الأكاديمية
                        </h4>
                        <p class="mb-0 text-white-50">
                            هنا يمكنك إدارة جميع التقييمات الأكاديمية للطلاب والمعلمين
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-clipboard-check text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('evaluations.create') }}" class="btn btn-violet shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> إضافة تقييم جديد
            </a>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="ابحث عن تقييم...">
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

    <!-- Evaluations Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-violet">
                <i class="fas fa-list me-2"></i> التقييمات المسجلة
            </h5>
            <span class="badge bg-violet">
                {{ $evaluations->total() }} تقييم
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th>المعلم</th>
                            <th>الطالب</th>
                            <th>الصف</th>
                            <th>المقيم</th>
                            <th width="120">التاريخ</th>
                            <th width="150">التقييم</th>
                            <th width="120" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evaluations as $evaluation)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-violet-light rounded-circle">
                                            <i class="fas fa-chalkboard-teacher text-violet"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $evaluation->teacher->name }}</h6>
                                        <small class="text-muted">{{ $evaluation->teacher->subject }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-indigo-light rounded-circle">
                                            <i class="fas fa-user-graduate text-indigo"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $evaluation->student->name }}</h6>
                                        <small class="text-muted">{{ $evaluation->student->class->name }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $evaluation->class->name }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $evaluation->evaluator_name }}</span>
                            </td>
                            <td>{{ $evaluation->evaluation_date->format('Y/m/d') }}</td>
                            <td>
                                <div class="evaluation-preview">
                                    {{ Str::limit($evaluation->evaluation, 30) }}
                                    @if(strlen($evaluation->evaluation) > 30)
                                    <a href="#" class="text-violet read-more"
                                       data-fulltext="{{ $evaluation->evaluation }}"
                                       data-bs-toggle="tooltip" title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('evaluations.show', $evaluation->id) }}"
                                       class="btn btn-sm btn-outline-violet rounded-3"
                                       data-bs-toggle="tooltip"
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('evaluations.edit', $evaluation->id) }}"
                                        class="btn btn-sm btn-outline-violet rounded-3"
                                        data-bs-toggle="tooltip"
                                       title="تعديل التقييم">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                          class="btn btn-sm btn-outline-violet rounded-3"
                                            data-bs-toggle="tooltip"
                                                title="حذف التقييم"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا التقييم؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-star fa-3x mb-3 text-muted"></i>
                                <h5 class="text-muted">لا توجد تقييمات مسجلة</h5>
                                <p class="text-muted">يمكنك إضافة تقييم جديد بالنقر على زر "إضافة تقييم جديد"</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($evaluations->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-center">
                {{ $evaluations->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal لعرض النص الكامل -->
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-violet text-white">
                <h5 class="modal-title" id="evaluationModalLabel">
                    <i class="fas fa-file-alt me-2"></i> نص التقييم الكامل
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="fullEvaluationText" style="white-space: pre-line; line-height: 1.8;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-violet" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> إغلاق
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // عرض النص الكامل للتقييم
    $('.read-more').click(function(e) {
        e.preventDefault();
        $('#fullEvaluationText').text($(this).data('fulltext'));
        $('#evaluationModal').modal('show');
    });
});
</script>
@endpush

@push('styles')
<style>
    .bg-violet {
        background-color: #6f42c1 !important;
    }

    .bg-violet-light {
        background-color: rgba(111, 66, 193, 0.1);
    }

    .bg-indigo-light {
        background-color: rgba(102, 16, 242, 0.1);
    }

    .text-violet {
        color: #6f42c1 !important;
    }

    .btn-violet {
        background-color: #6f42c1;
        color: white;
        border-color: #6f42c1;
    }

    .btn-violet:hover {
        background-color: #6610f2;
        border-color: #6610f2;
        color: white;
    }

    .btn-outline-violet {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-violet:hover {
        background-color: #6f42c1;
        color: white;
    }

    .welcome-card .card {
        border-radius: 0.75rem;
    }

    .avatar-sm {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 1rem;
    }

    .evaluation-preview {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(111, 66, 193, 0.05);
    }
</style>
@endpush
