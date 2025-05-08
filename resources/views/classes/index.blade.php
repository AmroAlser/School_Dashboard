@extends('layouts.app')

@section('title', 'إدارة الصفوف الدراسية')
@section('page-title', 'قائمة الصفوف')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center">
                <i class="fas fa-chalkboard-teacher fs-4 me-3"></i>
                <h5 class="mb-0 fw-semibold">سجل الصفوف الدراسية</h5>
            </div>
            <a href="{{ route('classes.create') }}" class="btn btn-light btn-sm rounded-pill px-3 py-1">
                <i class="fas fa-plus-circle me-1"></i> إضافة صف جديد
            </a>
        </div>

        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 rounded-3 shadow-sm">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2 fs-5"></i>
                        <span class="fw-medium">{{ session('success') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="filter-card mb-4 p-3 bg-light rounded-3 shadow-sm">
                <form action="{{ route('classes.index') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="classFilter" class="form-label mb-1 text-muted small">تصفية حسب الصف:</label>
                            <select name="class" id="classFilter" class="form-select form-select-sm shadow-none">
                                <option value="">جميع الصفوف</option>
                                @foreach($classes as $classItem)
                                    <option value="{{ $classItem->id }}" {{ request('class') == $classItem->id ? 'selected' : '' }}>
                                        {{ $classItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm mt-4">
                                <i class="fas fa-filter me-1"></i> تطبيق
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive rounded-3 shadow-sm border">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60px" class="text-center">#</th>
                            <th>اسم الصف</th>
                            <th class="text-center">عدد الطلاب</th>
                            <th width="200px" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                            <tr class="align-middle">
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="class-icon me-3">
                                            <i class="fas fa-chalkboard text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $class->name }}</h6>
                                            <small class="text-muted">تاريخ الإنشاء: {{ $class->created_at->format('Y-m-d') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="student-count-badge">{{ $class->students_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('classes.show', $class->id) }}"
                                            class="btn btn-action btn-view rounded-3"
                                            data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('classes.edit', $class->id) }}"
                                            class="btn btn-action btn-view rounded-3"
                                            data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-action btn-view rounded-3"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="حذف"
                                                    data-class-name="{{ $class->name }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-chalkboard fa-3x text-muted mb-3"></i>
                                        <h5 class="fw-semibold">لا توجد صفوف مسجلة</h5>
                                        <p class="text-muted">يمكنك إضافة صف جديد بالضغط على زر "إضافة صف جديد"</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($classes->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $classes->links('pagination::bootstrap-5') }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .class-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 10px;
    }

    .student-count-badge {
        display: inline-block;
        min-width: 30px;
        padding: 5px 10px;
        background-color: #f0f7ff;
        color: #0d6efd;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 10px !important;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .delete-btn:hover {
        background-color: #dc3545 !important;
    }

    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }

    .filter-card {
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        border: 1px solid #e9ecef;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-bottom: 2px solid #f1f1f1;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }

    .table td {
        padding: 16px;
        vertical-align: middle;
        border-color: #f9f9f9;
    }

    .table tr:hover {
        background-color: #f8fafc;
    }

    .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });

        // Custom delete confirmation
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            const className = $(this).data('class-name');
            const form = $(this).closest('form');

            Swal.fire({
                title: 'تأكيد الحذف',
                html: `هل أنت متأكد من حذف الصف <strong>${className}</strong>؟<br>سيتم حذف جميع البيانات المرتبطة به`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Auto-submit filter when selection changes
        $('#classFilter').on('change', function() {
            if(this.value) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
@endpush
