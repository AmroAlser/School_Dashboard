@extends('layouts.app')

@section('title', 'الرئيسية')
@section('page-title', 'لوحة التحكم')
@section('title-icon', 'fas fa-tachometer-alt')

@section('content')
{{-- <div class="container-fluid">
    <div class="alert alert-info d-flex align-items-center justify-content-between gap-3 flex-wrap" role="alert">
    <div>
        👤 <strong>أحدث طالب:</strong>
        {{ $latestStudent ? $latestStudent->name . ' (' . $latestStudent->created_at->format('Y-m-d') . ')' : 'لا يوجد طلاب مسجلين بعد' }}
    </div>
    <div>
        📝 <strong>آخر تقييم:</strong>
        {{ $latestEvaluation ? $latestEvaluation->title . ' - ' . $latestEvaluation->created_at->format('Y-m-d') : 'لا يوجد تقييمات بعد' }}
    </div>
    <div>
        📅 <strong>الفصل الدراسي:</strong>
        @if (is_null($daysLeft))
            لم يتم تحديد فصل نشط حاليًا
        @elseif ($daysLeft > 10)
            متبقي {{ $daysLeft }} يومًا حتى نهاية الفصل
        @elseif ($daysLeft > 0)
            <span class="text-danger">⚠ متبقي {{ $daysLeft }} يوم فقط!</span>
        @else
            <span class="text-danger">⚠ انتهى الفصل الدراسي!</span>
        @endif
    </div>
</div> --}}

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
                            <img src="{{ asset('images/image.png') }}" alt="شعار النظام" style="height: 40px; margin: 0 10px;">
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
                            <small class="{{ $studentsIncrease >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-caret-{{ $studentsIncrease >= 0 ? 'up' : 'down' }} me-1"></i>
                                {{ abs($studentsIncrease) }}% {{ $studentsIncrease >= 0 ? 'زيادة' : 'نقصان' }}
                            </small>
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
                            <small class="{{ $teachersIncrease >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-caret-{{ $teachersIncrease >= 0 ? 'up' : 'down' }} me-1"></i>
                                {{ abs($teachersIncrease) }}% {{ $teachersIncrease >= 0 ? 'زيادة' : 'نقصان' }}
                            </small>
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
                            <small class="text-muted">{{ $newClassesThisMonth }} صفوف جديدة</small>
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
                            <small class="text-danger">
                                <i class="fas fa-caret-down me-1"></i> {{ $endedSemesters }} فصل منتهي
                            </small>
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
    <!-- مخططات إحصائية إضافية -->

   <div class="row">
    <!-- قسم الطلاب -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100 animate__animated animate__fadeInUp">
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
                        <li><a class="dropdown-item" href="{{ route('reports.allstudents') }}"><i class="fas fa-file-export me-2"></i>تصدير البيانات</a></li>
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
                        <h5 class="mb-1 text-success" data-bs-toggle="tooltip" title="عدد الطلاب الجدد">{{ $latestStudents->count() }}</h5>
                        <small class="text-muted">جدد</small>
                    </div>
                    <div class="col-4 border-end">
                        <h5 class="mb-1">{{ $studentsCount > 0 ? number_format($latestStudents->count() / $studentsCount * 100, 2) : '0.00' }}%</h5>
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

    <!-- قسم المعلمين -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100 animate__animated animate__fadeInUp">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-chalkboard-teacher me-2"></i>إدارة المعلمين
                </h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('teachers.create') }}"><i class="fas fa-user-plus me-2"></i>إضافة معلم</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.teachers') }}"><i class="fas fa-file-export me-2"></i>تصدير البيانات</a></li>
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
                        <h5 class="mb-1 text-success" data-bs-toggle="tooltip" title="عدد المعلمين الجدد">{{ $latestTeachers->count() }}</h5>
                        <small class="text-muted">جدد</small>
                    </div>
                    <div class="col-4 border-end">
                        <h5 class="mb-1">{{ $teachersCount > 0 ? number_format($latestTeachers->count() / $teachersCount * 100, 2) : '0.00' }}%</h5>
                        <small class="text-muted">نسبة الجدد</small>
                    </div>
                    <div class="col-4">
                        <h5 class="mb-1">{{ $teachersCount }}</h5>
                        <small class="text-muted">إجمالي المعلمين</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- القسم الثاني -->
<div class="row">
    <!-- إحصائيات الطلاب شهرياً -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100 animate__animated animate__fadeInUp">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-bar me-2"></i>إحصائيات الطلاب الجدد شهرياً
                </h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('reports.students') }}"><i class="fas fa-file-export me-2"></i>تقرير تفصيلي</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="studentsMonthlyChart" height="240"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- أداء المعلمين -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm h-100 animate__animated animate__fadeInUp">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-chart-line me-2"></i>مؤشر أداء المعلمين
                </h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('reports.teachers') }}"><i class="fas fa-file-export me-2"></i>تقرير تفصيلي</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-line">
                    <canvas id="teachersPerformanceChart" height="240"></canvas>
                </div>
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

        <!-- أحدث المعلمين -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-user-plus me-2"></i>أحدث المعلمين
                    </h6>
                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-success">
                        <i class="fas fa-list"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead class="bg-light-success">
                                <tr>
                                    <th>المعلم</th>
                                    <th>التخصص</th>
                                    <th>المادة</th>
                                    <th class="text-end">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestTeachers as $teacher)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2 bg-success-light rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user-tie text-success"></i>
                                            </div>
                                            <div>{{ $teacher->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $teacher->specialization }}</td>
                                    <td>
                                        @if($teacher->subject)
                                            <span class="badge bg-primary rounded-pill">{{ $teacher->subject->name }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// تحسين عرض البيانات في الكونسول لأغراض التصحيح
console.log('Students by Class:', @json($studentsByClass));
console.log('Teachers by Specialization:', @json($teachersBySpecialization));

// إعدادات عامة للرسوم البيانية
Chart.defaults.font.family = 'Tajawal, sans-serif';
Chart.defaults.color = '#6c757d';

// 1. مخطط الطلاب حسب الصف (دونات)
const studentsChart = new Chart(
    document.getElementById('studentsChart').getContext('2d'),
    {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($studentsByClass->keys()) !!},
            datasets: [{
                data: {!! json_encode($studentsByClass->values()) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                    '#e74a3b', '#858796', '#5a5c69', '#3a3b45'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'right',
                    rtl: true,
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    rtl: true,
                    bodyAlign: 'right',
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw || 0;
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} طالب (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    }
);

// 2. مخطط المعلمين حسب التخصص (دونات)
const teachersChart = new Chart(
    document.getElementById('teachersChart').getContext('2d'),
    {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($teachersBySpecialization->keys()) !!},
            datasets: [{
                data: {!! json_encode($teachersBySpecialization->values()) !!},
                backgroundColor: [
                    '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                    '#858796', '#5a5c69', '#3a3b45', '#4e73df'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'right',
                    rtl: true,
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    rtl: true,
                    bodyAlign: 'right',
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw || 0;
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} معلم (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    }
);

// 3. مخطط الطلاب الجدد شهرياً (عمودي)
const studentsMonthlyChart = new Chart(
    document.getElementById('studentsMonthlyChart').getContext('2d'),
    {
        type: 'bar',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
            datasets: [{
                label: 'الطلاب الجدد',
                data: {!! json_encode($studentsMonthlyData ?? array_fill(0, 12, 0)) !!},
                backgroundColor: 'rgba(78, 115, 223, 0.8)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    rtl: true,
                    bodyAlign: 'right'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    }
);

// 4. مخطط أداء المعلمين (خطي)
const teachersPerformanceChart = new Chart(
    document.getElementById('teachersPerformanceChart').getContext('2d'),
    {
        type: 'line',
        data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
            datasets: [{
                label: 'متوسط التقييم',
                data: {!! json_encode($teachersPerformanceData ?? [85, 88, 92, 95, 90, 93]) !!},
                fill: true,
                backgroundColor: 'rgba(28, 200, 138, 0.1)',
                borderColor: '#1cc88a',
                borderWidth: 2,
                pointBackgroundColor: '#1cc88a',
                pointBorderColor: '#fff',
                pointHoverRadius: 6,
                pointRadius: 4,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    rtl: true,
                    bodyAlign: 'right'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    min: 50,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    }
);

</script>
<script>
    function fetchAlerts() {
        fetch('{{ route('dashboard.refresh.alerts') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('latest-student').textContent = data.latest_student;
                document.getElementById('latest-evaluation').textContent = data.latest_evaluation;

                const semesterInfo = document.getElementById('semester-info');
                if (data.days_left === null) {
                    semesterInfo.innerHTML = 'لم يتم تحديد فصل نشط';
                } else if (data.days_left > 10) {
                    semesterInfo.innerHTML = `متبقي ${data.days_left} يوم حتى نهاية الفصل`;
                } else if (data.days_left > 0) {
                    semesterInfo.innerHTML = `<span class="text-danger">⚠ متبقي ${data.days_left} يوم فقط!</span>`;
                } else {
                    semesterInfo.innerHTML = `<span class="text-danger">⚠ انتهى الفصل الدراسي!</span>`;
                }
            })
            .catch(error => {
                console.error('Error fetching alerts:', error);
                // alert('حدث خطأ أثناء التحديث!');
            });
    }

    // عند الضغط على زر التحديث
    document.getElementById('refresh-alerts').addEventListener('click', fetchAlerts);

    // تحديث تلقائي كل 60 ثانية (60000 ملي ثانية)
    setInterval(fetchAlerts, 60000);
</script>
@endpush


@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --primary-dark: #224abe;
        --success-color: #1cc88a;
        --success-dark: #17a673;
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
    .chart-bar, .chart-line {
    position: relative;
    height: 240px;
    width: 100%;
}

.card .dropdown-menu {
    min-width: 12rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 0.85rem;
    color: #858796;
    background-color: #fff;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
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

    .bg-light-success {
        background-color: rgba(28, 200, 138, 0.05);
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

    .text-success {
        color: var(--success-color);
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

    .bg-success {
        background-color: var(--success-color);
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

    .btn-outline-success {
        color: var(--success-color);
        border-color: var(--success-color);
    }

    .btn-outline-success:hover {
        background-color: var(--success-color);
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
