@extends('layouts.app')

@section('title', 'إدارة الصفوف الدراسية')
@section('page-title', 'قائمة الصفوف')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="fas fa-chalkboard-teacher me-2"></i> الصفوف الدراسية
            </h5>
            <a href="{{ route('classes.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-1"></i> إضافة صف جديد
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th>اسم الصف</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-primary-light rounded-circle">
                                            <i class="fas fa-chalkboard text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <strong>{{ $class->name }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-warning" title="تعديل" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="حذف" data-bs-toggle="tooltip" onclick="return confirm('هل أنت متأكد من حذف الصف؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="fas fa-chalkboard fa-2x mb-3"></i>
                                <p class="mb-0">لا توجد صفوف مسجلة</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

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

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
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
</style>
@endpush
