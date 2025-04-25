@extends('layouts.app')

@section('title', 'إدارة التقييمات')
@section('page-title', 'قائمة التقييمات')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-star-half-alt me-2"></i>التقييمات الأكاديمية
            </h5>
            <a href="{{ route('evaluations.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> تقييم جديد
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">المعلم</th>
                            <th width="15%">الطالب</th>
                            <th width="12%">المقيم</th>
                            <th width="10%">الرقم الوظيفي</th>
                            <th width="10%">التاريخ</th>
                            <th width="23%">التقييم</th>
                            <th width="10%">الإجراءات</th>
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
                                <td class="text-truncate" style="max-width: 120px;" title="{{ $evaluation->evaluator_name }}">
                                    {{ $evaluation->evaluator_name }}
                                </td>
                                <td class="text-center">
                                    {{ $evaluation->evaluator_job_number }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($evaluation->evaluation_date)->format('d/m/Y') }}
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
                                        <a href="{{ route('evaluations.show', $evaluation) }}" class="btn btn-sm btn-info" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-sm btn-warning" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا التقييم؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">لا توجد تقييمات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($evaluations instanceof \Illuminate\Pagination\AbstractPaginator && $evaluations->hasPages())
                <div class="d-flex justify-content-center mt-3">
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
                <h5 class="modal-title">نص التقييم الكامل</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="fullEvaluationText" style="white-space: pre-line;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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
    .table {
        font-size: 0.9rem;
    }

    .table th {
        vertical-align: middle;
        text-align: center;
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .table td {
        vertical-align: middle;
    }

    .evaluation-text {
        line-height: 1.5;
    }

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

    .btn-group .btn {
        padding: 0.2rem 0.4rem;
        font-size: 0.8rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 1rem 1.5rem;
    }

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }
</style>
@endpush
