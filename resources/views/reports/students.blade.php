@extends('layouts.app')

@section('title', 'تقرير الطلاب')
@section('page-title', 'تقرير الطلاب')
@section('title-icon', 'fas fa-users')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6610f2, #6f42c1);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-users me-2"></i> تقرير الطلاب
                        </h4>
                        <p class="mb-0 text-white-50">
                            قائمة كاملة بجميع الطلاب المسجلين في النظام
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-user-graduate text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-indigo text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i> الطلاب المسجلين
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-light" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> طباعة
                </button>
                <a href="{{ route('export.students') }}" class="btn btn-light">
                    <i class="fas fa-file-excel me-1"></i> تصدير
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>الجنس</th>
                            <th>العمر</th>
                            <th>الصف</th>
                            <th>الفصل الدراسي</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-indigo-light rounded-circle">
                                            <i class="fas fa-user-graduate text-indigo"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <strong>{{ $student->name }}</strong>
                                        <div class="text-muted small">{{ $student->entry_date }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->national_id }}</td>
                            <td>
                                <span class="badge {{ $student->gender == 'ذكر' ? 'bg-info' : 'bg-pink' }}">
                                    {{ $student->gender }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($student->birth_date)->age }} سنة</td>
                            <td>{{ optional($student->class)->name ?? 'غير محدد' }}</td>
                            <td>{{ optional($student->semester)->name ?? 'غير محدد' }}</td>
                            <td>
                                <span class="badge {{ $student->status == 'مواطن' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-user-slash fa-2x mb-3"></i>
                                <p class="mb-0">لا يوجد طلاب مسجلين</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($students->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $students->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-indigo {
        background-color: #6610f2 !important;
    }

    .bg-indigo-light {
        background-color: rgba(102, 16, 242, 0.1);
    }

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

    .bg-pink {
        background-color: #e83e8c;
        color: white;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
    }

    @media print {
        .welcome-card, .card-header {
            display: none !important;
        }

        body {
            background: white !important;
            font-size: 10pt;
        }

        .table {
            font-size: 10pt;
        }
    }
</style>
@endpush
