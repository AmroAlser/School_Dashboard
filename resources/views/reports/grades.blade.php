@extends('layouts.app')

@section('title', 'تقرير الدرجات')
@section('page-title', 'تقرير الدرجات')
@section('title-icon', 'fas fa-clipboard-check')

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745, #218838);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-clipboard-check me-2"></i> تقرير الدرجات
                        </h4>
                        <p class="mb-0 text-white-50">
                            تقييم أداء الطلاب في المواد الدراسية
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-award text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">
                <i class="fas fa-clipboard-check me-2"></i> سجل الدرجات
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-light" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> طباعة
                </button>
                <a href="{{ route('export.grades', ['semester_id' => request('semester-filter'), 'subject_id' => request('subject-filter')]) }}"
                   class="btn btn-light">
                    <i class="fas fa-file-excel me-1"></i> تصدير
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-filter text-success"></i>
                        </span>
                        <select class="form-select" id="semester-filter">
                            <option value="">كل الفصول</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ request('semester-filter') == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-book text-success"></i>
                        </span>
                        <select class="form-select" id="subject-filter">
                            <option value="">كل المواد</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject-filter') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-success"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="search-input" placeholder="بحث...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="grades-table">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>الطالب</th>
                            <th>المادة</th>
                            <th>الصف</th>
                            <th>الفصل</th>
                            <th width="100">الدرجة</th>
                            <th width="150">التقييم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <span class="avatar-title bg-success-light rounded-circle">
                                            <i class="fas fa-user text-success"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <strong>{{ $grade->student->name }}</strong>
                                        <div class="text-muted small">{{ $grade->student->national_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $grade->subject->name }}</td>
                            <td>{{ $grade->class->name }}</td>
                            <td>{{ $grade->semester->name }}</td>
                            <td class="text-center">
                                <span class="badge {{ $grade->score >= 90 ? 'bg-primary' : ($grade->score >= 60 ? 'bg-success' : 'bg-danger') }}">
                                    {{ $grade->score }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar {{ $grade->score >= 90 ? 'bg-primary' : ($grade->score >= 60 ? 'bg-success' : 'bg-danger') }}"
                                             role="progressbar" style="width: {{ $grade->score }}%"
                                             aria-valuenow="{{ $grade->score }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $grade->score }}%</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-clipboard fa-2x mb-3"></i>
                                <p class="mb-0">لا توجد درجات مسجلة</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($grades->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $grades->appends(request()->input())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // فلترة الجدول
        function filterGrades() {
            const semester = $('#semester-filter').val();
            const subject = $('#subject-filter').val();
            const search = $('#search-input').val().toLowerCase();

            $('#grades-table tbody tr').each(function() {
                const rowSemester = $(this).find('td:eq(4)').text();
                const rowSubject = $(this).find('td:eq(2)').text();
                const rowText = $(this).text().toLowerCase();

                const semesterMatch = !semester || rowSemester.includes($('#semester-filter option:selected').text());
                const subjectMatch = !subject || rowSubject.includes($('#subject-filter option:selected').text());
                const searchMatch = !search || rowText.includes(search);

                $(this).toggle(semesterMatch && subjectMatch && searchMatch);
            });
        }

        $('#semester-filter, #subject-filter').change(filterGrades);
        $('#search-input').keyup(filterGrades);
    });
</script>
@endpush

@push('styles')
<style>
    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }

    .progress {
        border-radius: 3px;
        background-color: #f0f0f0;
    }

    .progress-bar {
        border-radius: 3px;
    }

    @media print {
        .welcome-card, .card-header, .input-group {
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
