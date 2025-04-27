@extends('layouts.app')

@section('title', 'تقرير الدرجات')
@section('page-title', 'تقرير الدرجات')
@section('title-icon', 'fas fa-clipboard-check')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-clipboard-check me-2"></i>تقرير الدرجات
            </h5>
            <div>
                <button class="btn btn-light" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> طباعة
                </button>
                <a href="{{ route('export.grades', ['semester_id' => request('semester-filter'), 'subject_id' => request('subject-filter')]) }}" class="btn btn-warning ms-2">
                    <i class="fas fa-file-excel me-1"></i> تصدير
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" id="semester-filter">
                            <option value="">كل الفصول</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-success" type="button" id="filter-btn">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="subject-filter">
                        <option value="">كل المواد</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="search-input" placeholder="بحث...">
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
                            <th>الدرجة</th>
                            <th>التقييم</th>
                            <th>التاريخ</th>
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
                            <td>
                                <span class="badge {{ $grade->score >= 90 ? 'bg-primary' : ($grade->score >= 60 ? 'bg-success' : 'bg-danger') }}">
                                    {{ $grade->score }}
                                </span>
                            </td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar {{ $grade->score >= 90 ? 'bg-primary' : ($grade->score >= 60 ? 'bg-success' : 'bg-danger') }}"
                                         role="progressbar" style="width: {{ $grade->score }}%"
                                         aria-valuenow="{{ $grade->score }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $grade->created_at->format('Y-m-d') }}</td>
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
        $('#filter-btn').click(function() {
            const semester = $('#semester-filter').val();
            const subject = $('#subject-filter').val();
            const search = $('#search-input').val().toLowerCase();

            $('#grades-table tbody tr').each(function() {
                const rowSemester = $(this).find('td:eq(3)').text();
                const rowSubject = $(this).find('td:eq(2)').text();
                const rowText = $(this).text().toLowerCase();

                const semesterMatch = !semester || rowSemester.includes($('#semester-filter option:selected').text());
                const subjectMatch = !subject || rowSubject.includes($('#subject-filter option:selected').text());
                const searchMatch = !search || rowText.includes(search);

                $(this).toggle(semesterMatch && subjectMatch && searchMatch);
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .bg-success-light {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .progress {
        border-radius: 3px;
        background-color: #f0f0f0;
    }

    .progress-bar {
        border-radius: 3px;
    }
</style>
@endpush
