@extends('layouts.app')

@section('title', 'قائمة الطلاب')
@section('page-title', 'إدارة الطلاب')
@section('title-icon', 'fas fa-users')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
            <div>
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i> سجل الطلاب
                    <span class="badge bg-white text-primary ms-2">{{ $students->total() }} طالب</span>
                </h5>
            </div>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <a href="{{ route('students.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> تسجيل طالب جديد
                </a>
                <a href="{{route('reports.allstudents')}}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-1"></i> تصدير البيانات
                </a>
                {{-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import me-1"></i> استيراد
                </button> --}}
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-0">
            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
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

            <!-- Advanced Filter Section -->
            <div class="p-3 border-bottom bg-light">
                <form id="filterForm" class="row g-3 align-items-center">
                    <!-- Search Input -->
                    <div class="col-md-3">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control border-start-0"
                                   placeholder="ابحث بالاسم أو الرقم أو الهاتف...">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="col-md-2">
                        <select id="statusFilter" class="form-select form-select-sm">
                            <option value="">جميع الحالات</option>
                            <option value="مواطن">مواطن</option>
                            <option value="لاجئ">لاجئ</option>
                        </select>
                    </div>

                    <!-- Class Filter -->
                    <div class="col-md-2">
                        <select id="classFilter" class="form-select form-select-sm">
                            <option value="">جميع الصفوف</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->name }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Semester Filter -->
                    <div class="col-md-2">
                        <select id="semesterFilter" class="form-select form-select-sm">
                            <option value="">جميع الفصول</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->name }}">{{ $semester->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Disability Filter -->
                    {{-- <div class="col-md-2">
                        <select id="disabilityFilter" class="form-select form-select-sm">
                            <option value="">جميع الطلاب</option>
                            <option value="1">ذوي احتياجات</option>
                            <option value="0">لا يوجد إعاقة</option>
                        </select>
                    </div> --}}

                    <!-- Reset Button -->
                    <div class="col-md-1">
                        <button type="button" id="resetFilters" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Students Table -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th>الطالب</th>
                            <th width="120">رقم الهوية</th>
                            <th width="100">الصف</th>
                            <th width="100">الفصل</th>
                            <th width="80">العمر</th>
                            <th width="120">العنوان</th>
                            <th width="100">الإعاقة</th>
                            <th width="120">الحالة</th>
                            <th width="150">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTable">
                        @forelse($students as $student)
                        <tr class="student-row"
                            data-name="{{ $student->name }}"
                            data-id="{{ $student->national_id }}"
                            data-class="{{ $student->class->name ?? '' }}"
                            data-semester="{{ $student->semester->name ?? '' }}"
                            data-status="{{ $student->status }}"
                            data-disability="{{ $student->disability ? 1 : 0 }}"
                            data-phone="{{ $student->phone ?? '' }}"
                            data-address="{{ $student->address ?? '' }}">
                            <td class="text-center">{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{-- @if($student->report_image)
                                    <img src="{{ asset($student->report_image) }}" width="40" height="40" class="rounded-circle me-2" alt="صورة الطالب">
                                    @else --}}
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-primary-light rounded-circle">
                                            <i class="fas fa-user-graduate text-primary"></i>
                                        </span>
                                    </div>
                                    {{-- @endif --}}
                                    <div>
                                        <h6 class="mb-0">{{ $student->name }}</h6>
                                        <small class="text-muted d-block">{{ \Carbon\Carbon::parse($student->entry_date)->format('Y-m-d') }}</small>
                                        @if($student->phone)
                                        <small class="text-muted">
                                            <i class="fas fa-phone me-1"></i> {{ $student->phone }}
                                        </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->national_id }}</td>
                            <td>
                                <span class="badge bg-primary-light text-primary">
                                    {{ $student->class->name ?? 'غير محدد' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info-light text-info">
                                    {{ $student->semester->name ?? 'غير محدد' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark">
                                    {{ \Carbon\Carbon::parse($student->birth_date)->age }} سنة
                                </span>
                            </td>
                            <td>
                                @if($student->address)
                                <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $student->address }}">
                                    {{ $student->address }}
                                </span>
                                @else
                                <span class="text-muted">غير محدد</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($student->disability)
                                <span class="badge bg-danger">
                                  {{ $student->disability }}
                                </span>
                                @else
                                <span class="badge bg-success">لا يوجد</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $student->status == 'مواطن' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('students.show', $student->id) }}"
                                        class="btn btn-action btn-view rounded-3"
                                       data-bs-toggle="tooltip"
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('students.edit', $student->id) }}"
                                        class="btn btn-action btn-edit rounded-3"
                                       data-bs-toggle="tooltip"
                                       title="تعديل الطالب">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                               class="btn btn-action btn-delete rounded-3"
                                                data-bs-toggle="tooltip"
                                                title="حذف الطالب"
                                                onclick="return confirm('هل أنت متأكد من حذف الطالب {{ $student->name }}؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-user-graduate fa-4x text-muted mb-3"></i>
                                    <h4 class="mb-2">لا يوجد طلاب مسجلين</h4>
                                    <p class="text-muted mb-4">يمكنك البدء بإضافة طلاب جدد باستخدام زر "تسجيل طالب جديد"</p>
                                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> إضافة طالب جديد
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($students->hasPages())
                <div class="p-3 border-top d-flex justify-content-center">
                    {{ $students->appends(request()->input())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import me-2"></i> استيراد طلاب من ملف Excel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">اختر ملف Excel</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                        <div class="form-text">يجب أن يكون الملف بصيغة .xlsx أو .xls</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        يرجى التأكد من تنسيق الملف حسب النموذج المطلوب
                        <a href="{{ asset('templates/students_import_template.xlsx') }}" class="d-block mt-2">
                            <i class="fas fa-download me-1"></i> تحميل نموذج استيراد
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i> استيراد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Filter function
    function filterStudents() {
        const searchValue = $('#searchInput').val().toLowerCase();
        const statusValue = $('#statusFilter').val();
        const classValue = $('#classFilter').val();
        const semesterValue = $('#semesterFilter').val();
        const disabilityValue = $('#disabilityFilter').val();

        $('.student-row').each(function() {
            const name = $(this).data('name').toLowerCase();
            const id = $(this).data('id').toString();
            const phone = $(this).data('phone').toString();
            const studentClass = $(this).data('class');
            const semester = $(this).data('semester');
            const status = $(this).data('status');
            const disability = $(this).data('disability').toString();
            const address = $(this).data('address').toLowerCase();

            const matchesSearch = name.includes(searchValue) ||
                                id.includes(searchValue) ||
                                phone.includes(searchValue) ||
                                address.includes(searchValue);
            const matchesStatus = statusValue === '' || status === statusValue;
            const matchesClass = classValue === '' || studentClass === classValue;
            const matchesSemester = semesterValue === '' || semester === semesterValue;
            const matchesDisability = disabilityValue === '' || disability === disabilityValue;

            if (matchesSearch && matchesStatus && matchesClass && matchesSemester && matchesDisability) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Event listeners for filters
    $('#searchInput, #statusFilter, #classFilter, #semesterFilter, #disabilityFilter').on('input change', filterStudents);

    // Reset filters
    $('#resetFilters').click(function() {
        $('#searchInput').val('');
        $('#statusFilter').val('');
        $('#classFilter').val('');
        $('#semesterFilter').val('');
        $('#disabilityFilter').val('');
        filterStudents();
    });
});
</script>
@endpush

@push('styles')
<style>
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

    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .bg-info-light {
        background-color: rgba(23, 162, 184, 0.1);
    }

    .bg-pink {
        background-color: #e83e8c;
        color: white;
    }

    .table th {
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
        background-color: #f8f9fa;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        font-weight: 500;
        padding: 0.4em 0.75em;
        border-radius: 50px;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transform: translateX(3px);
        transition: all 0.3s ease;
    }

    .form-select-sm, .input-group-sm {
        font-size: 0.875rem;
    }

    .alert {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: all 0.2s;
    }

    .btn-view {
        color: #0d6efd;
        border: 1px solid #0d6efd;
    }

    .btn-view:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-edit {
        color: #ffc107;
        border: 1px solid #ffc107;
    }

    .btn-edit:hover {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-delete {
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }

    .empty-state {
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
    }

    @media (max-width: 768px) {
        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
        }

        .table th, .table td {
            white-space: nowrap;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .d-flex.gap-2 {
            margin-top: 10px;
            width: 100%;
            justify-content: flex-end;
        }
    }

    /* Custom scrollbar for table */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush
