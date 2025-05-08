@extends('layouts.app')

@section('title', 'قائمة المواد الدراسية')
@section('page-title', 'إدارة المواد الدراسية')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-book-open me-2"></i>سجل المواد الدراسية
            </h5>
            <a href="{{ route('subjects.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-1"></i> إضافة مادة جديدة
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('subjects.index') }}" method="GET" class="mb-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select name="subject" class="form-select" onchange="this.form.submit()">
                            <option value="">جميع المواد</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th width="60px">#</th>
                            <th>اسم المادة</th>
                            <th>عدد المعلمين</th>
                            <th width="180px">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $subject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="subject-icon me-2">
                                            <i class="fas fa-book text-primary"></i>
                                        </div>
                                        <strong>{{ $subject->name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $subject->teachers_count ?? 0 }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- زر عرض التفاصيل -->
                                         <a href="{{ route('subjects.show', $subject->id) }}"
                                           class="btn btn-action btn-view rounded-3"
                                           data-bs-toggle="tooltip"
                                           title="عرض التفاصيل">
                                            <i class="fas fa-eye me-1"></i>
                                        </a>

                                        <!-- زر التعديل -->
                                           <a href="{{ route('subjects.edit', $subject->id) }}"
                                           class="btn btn-action btn-edit rounded-3"
                                           data-bs-toggle="tooltip"
                                           title="تعديل المادة">
                                            <i class="fas fa-pen me-1"></i>
                                        </a>

                                        <!-- زر الحذف -->
                                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-action btn-delete rounded-3"
                                                    data-bs-toggle="tooltip"
                                                    title="حذف المادة"
                                                    onclick="return confirm('هل أنت متأكد من حذف المادة {{ $subject->name }}؟')">
                                                <i class="fas fa-trash me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                               
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-book-open fa-2x mb-3"></i>
                                    <p class="mb-0">لا توجد مواد مسجلة</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($subjects->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $subjects->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .subject-icon {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .alert {
        border-radius: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
