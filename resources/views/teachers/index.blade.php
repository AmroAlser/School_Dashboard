@extends('layouts.app')

@section('title', 'قائمة المعلمين')
@section('page-title', 'إدارة المعلمين')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-chalkboard-teacher me-2"></i>سجل المعلمين
            </h5>
            <a href="{{ route('teachers.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> معلم جديد
            </a>
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
                        <select name="subject_id" class="form-select" onchange="this.form.submit()">
                            <option value="">جميع المواد</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="40px">#</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <span class="avatar-title bg-success-light rounded-circle">
                                                <i class="fas fa-user-tie text-success"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <strong>{{ $teacher->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $teacher->national_id }}</td>
                                <td>{{ $teacher->specialization }}</td>
                                <td>
                                    @if($teacher->subject)
                                        <span class="badge bg-primary">{{ $teacher->subject->name }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('teachers.show', $teacher->id) }}"
                                           class="btn btn-info"
                                           title="عرض التفاصيل"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                           class="btn btn-warning"
                                           title="تعديل"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    title="حذف"
                                                    data-bs-toggle="tooltip"
                                                    onclick="return confirm('هل أنت متأكد من حذف المعلم {{ $teacher->name }}؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3"></i>
                                    <p class="mb-0">لا يوجد معلمون مسجلون</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($teachers->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $teachers->appends(request()->input())->links() }}
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
    });
</script>
@endpush

@push('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 0.875rem;
    }

    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .search-filter .input-group-text {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .search-filter .form-control {
        border-radius: 0 0.25rem 0.25rem 0;
    }
</style>
@endpush
