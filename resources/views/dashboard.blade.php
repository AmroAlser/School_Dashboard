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
                        <h4 class="mb-3 text-white">
                            <i class="fas fa-graduation-cap me-2"></i>
                            مرحباً بك في نظام إدارة المدرسة
                        </h4>
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
                            <li><a class="dropdown-item" href="{{ route('students.excel') }}"><i class="fas fa-file-export me-2"></i>تصدير البيانات</a></li>
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
                            <h5 class="mb-1">35</h5>
                            <small class="text-muted">جدد</small>
                        </div>
                        <div class="col-4 border-end">
                            <h5 class="mb-1">82%</h5>
                            <small class="text-muted">حضور</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-1">24</h5>
                            <small class="text-muted">متفوقون</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم الصفوف الدراسية -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-chalkboard me-2"></i>إدارة الصفوف
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('classes.create') }}"><i class="fas fa-plus me-2"></i>إضافة صف</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('classes.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="bg-light">
                                <tr>
                                    <th>الصف</th>
                                    <th>عدد الطلاب</th>
                                    <th>المعلمون</th>
                                    <th class="text-end">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestClasses as $class)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title bg-info-light rounded-circle">
                                                    <i class="fas fa-chalkboard text-info"></i>
                                                </span>
                                            </div>
                                            <div>{{ $class->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $class->students_count ?? 0 }}</td>
                                    <td>3</td>
                                    <td class="text-end">
                                        <span class="badge bg-success">نشط</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('classes.index') }}" class="btn btn-sm btn-info w-100 mt-3">
                        <i class="fas fa-list me-1"></i> عرض جميع الصفوف
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام الثانوية المحسنة -->
    <div class="row">
        <!-- المعلمون -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-chalkboard-teacher me-2"></i>إدارة المعلمين
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('teachers.create') }}"><i class="fas fa-user-plus me-2"></i>تعيين معلم</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('teachers.index') }}"><i class="fas fa-list me-2"></i>عرض الكل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie mb-4">
                        <canvas id="teachersChart" height="200"></canvas>
                    </div>
                    <div class="row text-center">
                        <div class="col-4 border-end">
                            <h5 class="mb-1">12</h5>
                            <small class="text-muted">أكفاء</small>
                        </div>
                        <div class="col-4 border-end">
                            <h5 class="mb-1">88%</h5>
                            <small class="text-muted">تقييم</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-1">5</h5>
                            <small class="text-muted">جدد</small>
                        </div>
                    </div>
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
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1 me-3">
                                <h6 class="mb-1">الفصل الأول 2023-2024</h6>
                                <div class="progress mb-1" style="height: 8px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted d-flex justify-content-between">
                                    <span>15/08/2023 - 20/12/2023</span>
                                    <span>75% مكتمل</span>
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-warning">جاري</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-3">
                                <h6 class="mb-1">الفصل الثاني 2022-2023</h6>
                                <div class="progress mb-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted d-flex justify-content-between">
                                    <span>10/01/2023 - 25/05/2023</span>
                                    <span>منتهي</span>
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-success">منتهي</span>
                            </div>
                        </div>
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
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-star-half-alt me-2"></i>أحدث التقييمات
                    </h6>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($latestEvaluations as $evaluation)
                        <div class="list-group-item border-0 px-0 py-2">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($evaluation->student->name) }}&background=4e73df&color=fff"
                                     width="40" height="40" class="rounded-circle me-3" alt="طالب">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $evaluation->student->name }}</h6>
                                    <small class="text-muted">تقييم من {{ $evaluation->teacher->name }}</small>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="badge bg-primary">{{ Str::limit($evaluation->evaluation, 20) }}</span>
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
                    <h6 class="m-0 font-weight-bold text-purple">
                        <i class="fas fa-user-plus me-2"></i>أحدث الطلاب
                    </h6>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-purple">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="bg-light">
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
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=6f42c1&color=fff"
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
            labels: ['الصف الأول', 'الصف الثاني', 'الصف الثالث', 'الصف الرابع'],
            datasets: [{
                data: [35, 28, 20, 17],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
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
                    textDirection: 'rtl'
                }
            },
            cutout: '75%',
        },
    });

    // رسم بياني للمعلمين حسب التخصص
    var ctxTeachers = document.getElementById('teachersChart').getContext('2d');
    var teachersChart = new Chart(ctxTeachers, {
        type: 'doughnut',
        data: {
            labels: ['العلوم', 'الرياضيات', 'اللغات', 'الاجتماعيات', 'الفنون'],
            datasets: [{
                data: [12, 8, 6, 4, 3],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617'],
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
                    textDirection: 'rtl'
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

    .bg-purple {
        background-color: var(--purple);
    }

    .text-purple {
        color: var(--purple);
    }

    .btn-outline-purple {
        color: var(--purple);
        border-color: var(--purple);
    }

    .btn-outline-purple:hover {
        background-color: var(--purple);
        color: white;
    }

    .progress-text {
        position: absolute;
        width: 100%;
        text-align: center;
        font-size: 0.75rem;
        color: white;
        text-shadow: 0 0 2px rgba(0,0,0,0.3);
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
