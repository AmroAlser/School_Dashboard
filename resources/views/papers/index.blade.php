@extends('layouts.app')

@section('title', 'إدارة الأوراق والتقارير')
@section('page-title', 'قائمة الأوراق والتقارير')
@section('title-icon', 'fas fa-file-alt')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-file-alt me-2"></i> نظام إدارة الأوراق والتقارير
                        </h4>
                        <p class="mb-0 text-white-50">
                            هنا يمكنك إدارة جميع الأوراق والتقارير في النظام
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-folder-open text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions & Filters -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="d-flex gap-2">
                <a href="{{ route('papers.create') }}" class="btn btn-violet shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i> إضافة ورقة جديدة
                </a>
                <button class="btn btn-outline-violet" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i> تصفية النتائج
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="ابحث عن ورقة...">
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
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

    <!-- Papers Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-violet">
                <i class="fas fa-list me-2"></i> الأوراق والتقارير المسجلة
            </h5>
            <span class="badge bg-violet">
                {{ $papers->total() }} ورقة
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th>العنوان</th>
                            <th width="150">نوع الملف</th>
                            <th width="150">تاريخ الإضافة</th>
                            <th width="120" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($papers as $paper)
                        <tr class="paper-row">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        @php
                                            $extension = pathinfo($paper->file, PATHINFO_EXTENSION);
                                            $icon = [
                                                'pdf' => 'file-pdf',
                                                'doc' => 'file-word',
                                                'docx' => 'file-word',
                                                'xls' => 'file-excel',
                                                'xlsx' => 'file-excel',
                                                'ppt' => 'file-powerpoint',
                                                'pptx' => 'file-powerpoint'
                                            ][$extension] ?? 'file-alt';
                                        @endphp
                                        <span class="avatar-title bg-violet-light rounded-circle">
                                            <i class="fas fa-{{ $icon }} text-violet"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $paper->title }}</h6>
                                        <small class="text-muted">تم التعديل: {{ $paper->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-uppercase">{{ $extension }}</span>
                            </td>
                            <td>{{ $paper->created_at->format('Y/m/d') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('papers.show', $paper->id) }}"
                                       class="btn btn-sm btn-outline-violet rounded-3"
                                       data-bs-toggle="tooltip"
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('papers.edit', $paper->id) }}"
                                        class="btn btn-sm btn-outline-violet rounded-3"
                                        data-bs-toggle="tooltip"
                                       title="تعديل الورقة">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('papers.destroy', $paper->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                          class="btn btn-sm btn-outline-violet rounded-3"
                                            data-bs-toggle="tooltip"
                                                title="حذف الورقة"
                                                onclick="return confirm('هل أنت متأكد من حذف الورقة {{ $paper->title }}؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">لا توجد أوراق مسجلة</h5>
                                <p class="text-muted">يمكنك إضافة ورقة جديدة بالنقر على زر "إضافة ورقة جديدة"</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($papers->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-center">
                {{ $papers->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-violet text-white">
                <h5 class="modal-title" id="filterModalLabel">
                    <i class="fas fa-filter me-2"></i> تصفية الأوراق
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="typeFilter" class="form-label">نوع الملف</label>
                        <select id="typeFilter" class="form-select">
                            <option value="">جميع الأنواع</option>
                            <option value="pdf">PDF</option>
                            <option value="doc">Word</option>
                            <option value="xls">Excel</option>
                            <option value="ppt">PowerPoint</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDateFilter" class="form-label">من تاريخ</label>
                            <input type="date" id="startDateFilter" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="endDateFilter" class="form-label">إلى تاريخ</label>
                            <input type="date" id="endDateFilter" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-violet">تطبيق التصفية</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-violet {
        background-color: #6a11cb !important;
    }

    .bg-violet-light {
        background-color: rgba(106, 17, 203, 0.1);
    }

    .text-violet {
        color: #6a11cb !important;
    }

    .btn-violet {
        background-color: #6a11cb;
        color: white;
        border-color: #6a11cb;
    }

    .btn-violet:hover {
        background-color: #2575fc;
        border-color: #2575fc;
        color: white;
    }

    .btn-outline-violet {
        color: #6a11cb;
        border-color: #6a11cb;
    }

    .btn-outline-violet:hover {
        background-color: #6a11cb;
        color: white;
    }

    .welcome-card .card {
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #6a11cb, #2575fc) !important;
    }

    .paper-row:hover {
        background-color: rgba(106, 17, 203, 0.05);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Filter function
    function filterPapers() {
        const typeValue = $('#typeFilter').val();
        const startDateValue = $('#startDateFilter').val();
        const endDateValue = $('#endDateFilter').val();

        $('.paper-row').each(function() {
            const rowType = $(this).find('.badge').text().toLowerCase();
            const rowDate = $(this).find('td:eq(3)').text();

            const matchesType = !typeValue || rowType.includes(typeValue);
            // Add date filter conditions as needed

            if (matchesType) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Apply filter when modal button is clicked
    $('.btn-violet').last().click(function() {
        filterPapers();
        $('#filterModal').modal('hide');
    });
});
</script>
@endpush
