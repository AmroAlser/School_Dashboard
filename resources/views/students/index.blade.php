@extends('layouts.app')

@section('title', 'قائمة الطلاب')
@section('page-title', 'إدارة الطلاب')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>سجل الطلاب
            </h5>
            <div>
                <a href="{{ route('students.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-1"></i> تسجيل طالب جديد
                </a>
                {{-- <a href="{{ route('students.export.excel') }}" class="btn btn-success ms-2">
                    <i class="fas fa-file-excel me-1"></i> تصدير للإكسل

                </a> --}}
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
                <form action="{{ route('students.index') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control"
                                   placeholder="ابحث بالاسم، رقم الهوية، الصف..."
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">بحث</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">جميع الحالات</option>
                            <option value="مواطن" {{ request('status') == 'مواطن' ? 'selected' : '' }}>مواطن</option>
                            <option value="لاجئ" {{ request('status') == 'لاجئ' ? 'selected' : '' }}>لاجئ</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>الصف</th>
                            <th>الجنس</th>
                            <th>العمر</th>
                            <th>رقم الجوال</th>
                            <th>العنوان</th>
                            <th>الإعاقة</th>
                            <th>هوية ولي الأمر</th>
                            <th>الحالة</th>
                            <th>السنة الدراسية</th>
                            <th>منقول من</th>
                            <th>منقول إلى</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <span class="avatar-title bg-primary-light rounded-circle">
                                                <i class="fas fa-user-graduate text-primary"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <strong>{{ $student->name }}</strong>
                                            <div class="text-muted small">{{ $student->entry_date }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $student->national_id }}</td>
                                <td>{{ $student->grade }}</td>
                                <td>
                                    <span class="badge {{ $student->gender == 'ذكر' ? 'bg-info' : 'bg-pink' }}">
                                        {{ $student->gender }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($student->birth_date)->age }} سنة</td>
                                <td>{{ $student->phone ?? '-' }}</td>
                                <td>{{ $student->address ?? '-' }}</td>
                                <td>{{ $student->disability ?? '-' }}</td>
                                <td>{{ $student->guardian_national_id ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $student->status == 'مواطن' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $student->status }}
                                    </span>
                                </td>
                                <td>{{ $student->academic_year }}</td>
                                <td>{{ $student->transferred_from ?? '-' }}</td>
                                <td>{{ $student->transferred_to ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info" title="عرض التفاصيل" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning" title="تعديل" data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="حذف" data-bs-toggle="tooltip" onclick="return confirm('هل أنت متأكد من حذف الطالب {{ $student->name }}؟')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" class="text-center py-4 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-3"></i>
                                    <p class="mb-0">لا يوجد طلاب مسجلين</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="d-flex gap-3 align-items-center">
                    <input type="file" name="file" class="form-control w-auto" required>
                    <button class="btn btn-success">
                        <i class="fas fa-file-import me-1"></i> استيراد من Excel
                    </button>
                </div>
            </form>

            @if($students->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $students->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        // تفعيل أدوات التلميح
        $('[data-bs-toggle="tooltip"]').tooltip();

        // يمكنك إضافة أي سكريبتات إضافية هنا
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

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
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
