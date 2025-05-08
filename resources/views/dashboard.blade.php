@extends('layouts.app')

@section('title', 'الرئيسية')
@section('page-title', 'لوحة التحكم')
@section('title-icon', 'fas fa-tachometer-alt')

@section('content')
<div class="container-fluid">
    <!-- رسالة الترحيب المحسنة -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #4e73df, #224abe);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-0 text-white">
                                <i class="fas fa-graduation-cap me-2"></i>
                                مرحباً بك في
                            </h4>
                            <img src="{{ asset('images/headerLogoar1.png') }}" alt="شعار النظام" style="height: 40px; margin: 0 10px;">
                        </div>
                        <h4 class="text-white mb-3">نظام إدارة المدرسة الهلال الخاصة</h4>
                        <p class="mb-0 text-white-50">
                            نظام متكامل لإدارة الطلاب، المعلمين، الصفوف الدراسية والتقييمات
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="bg-white bg-opacity-25 p-3 rounded d-inline-block">
                            <i class="fas fa-school text-white fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إحصائيات سريعة محسنة -->
    <div class="row mb-4">
        <!-- طلاب -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-start border-4 border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">عدد الطلاب</h6>
                            <h4 class="mb-0">{{ $studentsCount }}</h4>
                            <small class="text-success"><i class="fas fa-caret-up me-1"></i> 5.2% زيادة</small>
                        </div>
                        <div class="icon-circle bg-primary-light">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-2">
                    <a href="{{ route('students.index') }}" class="text-primary d-flex align-items-center justify-content-between">
                        <span>عرض التفاصيل</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- معلمون -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-start border-4 border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">عدد المعلمين</h6>
                            <h4 class="mb-0">{{ $teachersCount }}</h4>
                            <small class="text-success"><i class="fas fa-caret-up me-1"></i> 2.4% زيادة</small>
                        </div>
                        <div class="icon-circle bg-success-light">
                            <i class="fas fa-chalkboard-teacher text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-2">
                    <a href="{{ route('teachers.index') }}" class="text-success d-flex align-items-center justify-content-between">
                        <span>عرض التفاصيل</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- صفوف دراسية -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-start border-4 border-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">الصفوف الدراسية</h6>
                            <h4 class="mb-0">{{ $classesCount }}</h4>
                            <small class="text-muted">3 صفوف جديدة</small>
                        </div>
                        <div class="icon-circle bg-info-light">
                            <i class="fas fa-chalkboard text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-2">
                    <a href="{{ route('classes.index') }}" class="text-info d-flex align-items-center justify-content-between">
                        <span>عرض التفاصيل</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- فصول دراسية -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-start border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">الفصول الدراسية</h6>
                            <h4 class="mb-0">{{ $semestersCount }}</h4>
                            <small class="text-danger"><i class="fas fa-caret-down me-1"></i> فصل منتهي</small>
                        </div>
                        <div class="icon-circle bg-warning-light">
                            <i class="fas fa-calendar-alt text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-2">
                    <a href="{{ route('semesters.index') }}" class="text-warning d-flex align-items-center justify-content-between">
                        <span>عرض التفاصيل</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام الرئيسية المحسنة -->
    <div class="row">
        <!-- قسم الطلاب -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users me-2"></i>إدارة الطلاب
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('students.create') }}"><i class="fas fa-user-plus me-2"></i>إضافة طالب</a></li>
                            <li><a class="dropdown-item" href="{{route('reports.allstudents')}}"><i class="fas fa-file-export me-2"></i>تصدير البيانات</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('students.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie mb-4">
                        <canvas id="studentsChart" height="200"></canvas>
                    </div>
                    <div class="row text-center">
                        <div class="col-4 border-end">
                            <h5 class="mb-1">{{ $latestStudents->count() }}</h5>
                            <small class="text-muted">جدد</small>
                        </div>
                        <div class="col-4 border-end">
                            <h5 class="mb-1">{{ round(($studentsCount > 0 ? $latestStudents->count() / $studentsCount * 100 : 0), 2 ) }}% </h5>
                            <small class="text-muted">نسبة الجدد</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-1">{{ $studentsCount }}</h5>
                            <small class="text-muted">إجمالي الطلاب</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم الدورات -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-purple">
                        <i class="fas fa-certificate me-2"></i>إدارة الدورات
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-purple dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('courses.create') }}"><i class="fas fa-plus me-2"></i>إضافة دورة</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('courses.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="bg-light-purple">
                                <tr>
                                    <th>اسم الدورة</th>
                                    <th>المشرف</th>
                                    <th>عدد المشاركين</th>
                                    <th>تاريخ البدء</th>
                                    <th class="text-end">تاريخ الانتهاء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestCourses as $course)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title bg-purple-light rounded-circle">
                                                    <i class="fas fa-certificate text-purple"></i>
                                                </span>
                                            </div>
                                            <div>{{ $course->title }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $course->instructor }}</td>
                                    <td>{{ $course->participants }}</td>
                                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') }}</td>
                                    <td class="text-end">
                                        @php
                                            $endDate = \Carbon\Carbon::parse($course->end_date);
                                            $isActive = $endDate->isFuture(); // true لو التاريخ بعد اليوم
                                        @endphp
                                        <span class="badge bg-{{ $isActive ? 'success' : 'secondary' }}">
                                            {{ $isActive ? 'نشطة' : 'منتهية' }}
                                        </span>
                                        <div style="font-size: 0.8em; color: #888;">
                                            {{ $endDate->format('Y-m-d') }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('courses.index') }}" class="btn btn-sm btn-purple w-100 mt-3">
                        <i class="fas fa-list me-1"></i> عرض جميع الدورات
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام الثانوية المحسنة -->
    <div class="row">
        <!-- قسم الأوراق والتقارير -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-file-alt me-2"></i>الأوراق والتقارير
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('papers.create') }}"><i class="fas fa-plus me-2"></i>إضافة ورقة</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('papers.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($latestPapers as $paper)
                        <div class="list-group-item border-0 px-0 py-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-file-{{ in_array(pathinfo($paper->file, PATHINFO_EXTENSION), ['pdf']) ? 'pdf' : (in_array(pathinfo($paper->file, PATHINFO_EXTENSION), ['doc', 'docx']) ? 'word' : 'alt') }} text-danger fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $paper->title }}</h6>
                                    <small class="text-muted">تم الرفع: {{ $paper->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('papers.show', $paper->id) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('papers.index') }}" class="btn btn-sm btn-danger w-100 mt-3">
                        <i class="fas fa-list me-1"></i> عرض جميع الأوراق
                    </a>
                </div>
            </div>
        </div>

        <!-- الفصول الدراسية -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-calendar-alt me-2"></i>الفصول الدراسية
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('semesters.create') }}"><i class="fas fa-plus me-2"></i>إضافة فصل</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('semesters.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @foreach($activeSemesters as $semester)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1 me-3">
                                <h6 class="mb-1">{{ $semester->name }}</h6>
                                <div class="progress mb-1" style="height: 8px;">
                                    @php
                                        $progress = $semester->progress();
                                    @endphp
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted d-flex justify-content-between">
                                    <span>{{ $semester->start_date->format('d/m/Y') }} - {{ $semester->end_date->format('d/m/Y') }}</span>
                                    <span>{{ $progress }}% مكتمل</span>
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-{{ $semester->isActive() ? 'warning' : 'success' }}">{{ $semester->isActive() ? 'جاري' : 'منتهي' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('semesters.index') }}" class="btn btn-sm btn-warning w-100">
                        <i class="fas fa-calendar-check me-1"></i> عرض جميع الفصول
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- أحدث التقييمات والطلاب -->
    <div class="row">
        <!-- أحدث التقييمات -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-teal">
                        <i class="fas fa-star-half-alt me-2"></i>أحدث التقييمات
                    </h6>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-outline-teal">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($latestEvaluations as $evaluation)
                        <div class="list-group-item border-0 px-0 py-2">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($evaluation->student->name) }}&background=20c9a6&color=fff"
                                     width="40" height="40" class="rounded-circle me-3" alt="طالب">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $evaluation->student->name }}</h6>
                                    <small class="text-muted">تقييم من {{ $evaluation->teacher->name }}</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-teal">{{ Str::limit($evaluation->evaluation, 20) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- أحدث الطلاب المسجلين -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-indigo">
                        <i class="fas fa-user-plus me-2"></i>أحدث الطلاب
                    </h6>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-indigo">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="bg-light-indigo">
                                <tr>
                                    <th>الطالب</th>
                                    <th>الصف</th>
                                    <th>التاريخ</th>
                                    <th class="text-end">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestStudents as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=6610f2&color=fff"
                                                 width="30" height="30" class="rounded-circle me-2" alt="طالب">
                                            <div>{{ $student->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $student->class->name ?? 'غير محدد' }}</td>
                                    <td>{{ $student->created_at->format('d/m/Y') }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-success">نشط</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // رسم بياني للطلاب حسب الصف
    var ctxStudents = document.getElementById('studentsChart').getContext('2d');
    var studentsChart = new Chart(ctxStudents, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($studentsByClass->keys()) !!},
            datasets: [{
                data: {!! json_encode($studentsByClass->values()) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                    '#e74a3b', '#858796', '#5a5c69', '#3a3b45'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a',
                    '#be2617', '#6b6d7d', '#4a4b54', '#2a2b32'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                borderWidth: 2
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    rtl: true,
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    rtl: true,
                    textDirection: 'rtl',
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.raw || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((value / total) * 100);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            cutout: '75%',
        },
    });
</script>
@endpush

@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --primary-dark: #224abe;
        --purple: #6f42c1;
        --indigo: #6610f2;
        --teal: #20c9a6;
        --border-radius: 0.5rem;
        --transition: all 0.3s ease;
    }

    .welcome-card .card {
        border-radius: var(--border-radius);
        overflow: hidden;
    }

    .stat-card {
        transition: var(--transition);
        border-radius: var(--border-radius);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .icon-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
    }

    .bg-primary-light {
        background-color: rgba(78, 115, 223, 0.1);
    }

    .bg-success-light {
        background-color: rgba(28, 200, 138, 0.1);
    }

    .bg-info-light {
        background-color: rgba(54, 185, 204, 0.1);
    }

    .bg-warning-light {
        background-color: rgba(246, 194, 62, 0.1);
    }

    .bg-purple-light {
        background-color: rgba(111, 66, 193, 0.1);
    }

    .bg-light-purple {
        background-color: rgba(111, 66, 193, 0.05);
    }

    .bg-light-indigo {
        background-color: rgba(102, 16, 242, 0.05);
    }

    .text-purple {
        color: var(--purple);
    }

    .text-indigo {
        color: var(--indigo);
    }

    .text-teal {
        color: var(--teal);
    }

    .bg-purple {
        background-color: var(--purple);
    }

    .bg-indigo {
        background-color: var(--indigo);
    }

    .bg-teal {
        background-color: var(--teal);
    }

    .btn-purple {
        background-color: var(--purple);
        color: white;
    }

    .btn-purple:hover {
        background-color: #5e32a8;
        color: white;
    }

    .btn-outline-purple {
        color: var(--purple);
        border-color: var(--purple);
    }

    .btn-outline-purple:hover {
        background-color: var(--purple);
        color: white;
    }

    .btn-outline-indigo {
        color: var(--indigo);
        border-color: var(--indigo);
    }

    .btn-outline-indigo:hover {
        background-color: var(--indigo);
        color: white;
    }

    .btn-outline-teal {
        color: var(--teal);
        border-color: var(--teal);
    }

    .btn-outline-teal:hover {
        background-color: var(--teal);
        color: white;
    }

    .list-group-item {
        transition: var(--transition);
    }

    .list-group-item:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    .avatar-sm {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 0.8rem;
    }

    .table-sm td, .table-sm th {
        padding: 0.5rem;
    }

    .card {
        border-radius: var(--border-radius);
    }

    .chart-pie {
        position: relative;
        height: 200px;
    }
</style>
@endpush
