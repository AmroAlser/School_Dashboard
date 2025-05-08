@extends('layouts.app')
@section('title', 'قائمة الأوراق والتقارير')
@section('page-title', 'إدارة الأوراق والتقارير')
@section('title-icon', 'fas fa-file-alt')

@section('content')
<div class="container-fluid py-4">
    

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i> الأوراق المسجلة
            </h5>
            <div class="col-md-4 text-start">
                <a href="{{ route('papers.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i> إضافة ورقة جديدة
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th>العنوان</th>
                            <th width="20%" class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($papers as $paper)
                        <tr class="transition-all">
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">
                                <a href="{{ route('papers.show', $paper->id) }}" class="text-dark hover-text-primary">
                                    {{ $paper->title }}
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('papers.show', $paper->id) }}"
                                       class="btn btn-sm btn-link text-dark"
                                       data-bs-toggle="tooltip"
                                       title="عرض التفاصيل">
                                        <i class="fas fa-eye fa-lg"></i>
                                    </a>

                                    <a href="{{ route('papers.edit', $paper->id) }}"
                                       class="btn btn-sm btn-link text-dark"
                                       data-bs-toggle="tooltip"
                                       title="تعديل التقرير">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>

                                    <form action="{{ route('papers.destroy', $paper->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                               class="btn btn-sm btn-link text-dark"
                                                data-bs-toggle="tooltip"
                                                title="حذف التقرير"
                                                onclick="return confirm('هل أنت متأكد من حذف تقرير {{ $paper->title }}؟')">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">
                                <div class="py-4">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                    <h5 class="mb-2">لا توجد أوراق مسجلة</h5>
                                    <p class="text-muted">يمكنك إضافة أوراق جديدة باستخدام زر "إضافة ورقة جديدة"</p>
                                </div>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();

        $('tr.transition-all').hover(
            function() {
                $(this).addClass('bg-light shadow-sm');
            },
            function() {
                $(this).removeClass('bg-light shadow-sm');
            }
        );
    });
</script>
@endsection

<style>
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.85);
    }
    .hover-text-primary:hover {
        color: #0d6efd !important;
        text-decoration: none;
    }
    .transition-all {
        transition: all 0.2s ease;
    }
    .table-hover tbody tr:hover {
        transform: translateY(-1px);
    }
</style>
