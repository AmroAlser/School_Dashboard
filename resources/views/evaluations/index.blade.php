@extends('layouts.app')

@section('title', 'إدارة التقييمات')
@section('page-title', 'قائمة التقييمات')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="fas fa-star-half-alt me-2"></i> التقييمات الأكاديمية
            </h5>
            <div>
                <a href="{{ route('evaluations.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> تقييم جديد
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40" class="text-center">#</th>
                            <th>المعلم</th>
                            <th>الطالب</th>
                            <th>الصف</th>
                            <th>المقيم</th>
                            <th width="120" class="text-center">الرقم الوظيفي</th>
                            <th width="100" class="text-center">التاريخ</th>
                            <th>التقييم</th>
                            <th width="120" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($evaluations as $evaluation)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <span class="avatar-title bg-primary-light rounded-circle">
                                                <i class="fas fa-chalkboard-teacher text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="text-truncate" style="max-width: 150px;" title="{{ $evaluation->teacher->name }}">
                                            {{ $evaluation->teacher->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <span class="avatar-title bg-info-light rounded-circle">
                                                <i class="fas fa-user-graduate text-info"></i>
                                            </span>
                                        </div>
                                        <div class="text-truncate" style="max-width: 150px;" title="{{ $evaluation->student->name }}">
                                            {{ $evaluation->student->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-truncate" style="max-width: 120px;" title="{{ $evaluation->class->name }}">
                                    {{ $evaluation->class->name ?? 'غير محدد' }}
                                </td>
                                <td class="text-truncate" style="max-width: 120px;" title="{{ $evaluation->evaluator_name }}">
                                    {{ $evaluation->evaluator_name }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $evaluation->evaluator_job_number }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($evaluation->evaluation_date)->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <div class="evaluation-text">
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $evaluation->evaluation }}">
                                            {{ Str::limit($evaluation->evaluation, 50) }}
                                        </span>
                                        @if(strlen($evaluation->evaluation) > 50)
                                            <a href="#" class="text-primary read-more" data-fulltext="{{ $evaluation->evaluation }}">المزيد</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('evaluations.show', $evaluation) }}" class="btn btn-action btn-view rounded-3"
                                        data-bs-toggle="tooltip" title="عرض" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-action btn-view rounded-3"
                                        data-bs-toggle="tooltip"title="تعديل" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-action btn-view rounded-3"
                                            data-bs-toggle="tooltip" title="حذف"  onclick="return confirm('هل أنت متأكد من حذف هذا التقييم؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="fas fa-star fa-2x mb-3"></i>
                                    <p class="mb-0">لا توجد تقييمات مسجلة</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($evaluations instanceof \Illuminate\Pagination\AbstractPaginator && $evaluations->hasPages())
                <div class="p-3 border-top">
                    {{ $evaluations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal لعرض النص الكامل -->
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-alt me-2"></i>نص التقييم الكامل
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="fullEvaluationText" style="white-space: pre-line; line-height: 1.8;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> إغلاق
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // تفعيل أدوات التلميح
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
    .avatar-sm {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 0.8rem;
    }

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-info-light {
        background-color: rgba(23, 162, 184, 0.1);
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
        font-size: 0.85rem;
        vertical-align: middle;
    }

    .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    .evaluation-text {
        line-height: 1.6;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.04);
    }
</style>
@endpush
