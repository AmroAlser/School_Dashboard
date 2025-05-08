@extends('layouts.app')

@section('title', 'قائمة المعلمين')
@section('page-title', 'إدارة المعلمين')

@section('content')
<div class="container-fluid py-3">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-chalkboard-teacher me-2"></i>سجل المعلمين
            </h5>
            <div class="d-flex gap-2">
                <a href="{{ route('teachers.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-1"></i> معلم جديد
                </a>
                <a href="{{ route('reports.teachers') }}" class="btn btn-warning">
                    <i class="fas fa-file-excel me-1"></i> تصدير Excel
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="search-filter mb-4">
                <form action="{{ route('teachers.index') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control"
                                   placeholder="ابحث بالاسم، رقم الهوية، التخصص..."
                                   value="{{ request('search') }}">
                            <button class="btn btn-success" type="submit">بحث</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">
                                <i class="fas fa-filter"></i>
                            </span>
                            <select name="subject_id" class="form-select" onchange="this.form.submit()">
                                <option value="">جميع المواد</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped border">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="40px" class="bg-light">#</th>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>التخصص</th>
                            <th>المادة</th>
                            <th width="150px">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td class="text-center bg-light fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 bg-success-light rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-tie text-success"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $teacher->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td dir="ltr" class="text-center">{{ $teacher->national_id }}</td>
                                <td>{{ $teacher->specialization }}</td>
                                <td class="text-center">
                                    @if($teacher->subject)
                                        <span class="badge bg-primary rounded-pill px-3 py-2">{{ $teacher->subject->name }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- زر عرض التفاصيل -->
                                         <a href="{{ route('teachers.show', $teacher->id) }}"
                                           class="btn btn-action btn-view rounded-3"
                                           data-bs-toggle="tooltip"
                                           title="عرض التفاصيل">
                                            <i class="fas fa-eye me-1"></i>
                                        </a>

                                        <!-- زر التعديل -->
                                           <a href="{{ route('teachers.edit', $teacher->id) }}"
                                           class="btn btn-action btn-edit rounded-3"
                                           data-bs-toggle="tooltip"
                                           title="تعديل المعلم">
                                            <i class="fas fa-pen me-1"></i>
                                        </a>

                                        <!-- زر الحذف -->
                                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-action btn-delete rounded-3"
                                                    data-bs-toggle="tooltip"
                                                    title="حذف المعلم"
                                                    onclick="return confirm('هل أنت متأكد من حذف المعلم {{ $teacher->name }}؟')">
                                                <i class="fas fa-trash me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 text-secondary"></i>
                                        <h5>لا يوجد معلمون مسجلون</h5>
                                        <p>يمكنك إضافة معلمين جدد من خلال زر "معلم جديد"</p>
                                        <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-success mt-2">
                                            <i class="fas fa-plus me-1"></i> إضافة معلم جديد
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($teachers->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $teachers->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert-dismissible').alert('close');
        }, 5000);
    });
</script>
@endpush

@push('styles')
<style>
    /* Avatar styles */
    .avatar-sm {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }

    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }

    /* Table styles */
    .table {
        vertical-align: middle;
    }

    .table th {
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
    }

    /* Button styles */
    .btn-group .btn {
        padding: 0.375rem 0.5rem;
    }

    /* Card styles */
    .card {
        border-radius: 0.5rem;
        border: none;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 0.75rem 1.25rem;
    }

    /* Search filter styles */
    .search-filter .input-group-text {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .search-filter .form-control,
    .search-filter .form-select {
        box-shadow: none;
        border-color: #ced4da;
    }

    /* Pagination styling */
    .pagination {
        --bs-pagination-active-bg: #198754;
        --bs-pagination-active-border-color: #198754;
    }
</style>
@endpush
