@extends('layouts.app')

@section('title', 'الرئيسية')
@section('page-title', 'لوحة التحكم')

@section('content')
<div class="container-fluid">
    <!-- رسالة الترحيب -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #007bff, #0056b3);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-3 text-white">
                            <i class="fas fa-graduation-cap me-2 text-white"></i>
                            مرحباً بك في نظام إدارة المدرسة التأهيل
                        </h4>
                        <p class="mb-0 text-white-50">
                            هنا يمكنك إدارة جميع عمليات المدرسة من طلاب ومعلمين ومناهج وتقييمات في مكان واحد
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




    <!-- إحصائيات سريعة -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-xs font-weight-bold text-primary mb-1">عدد الطلاب</h6>
                            <h4 class="mb-0">{{ $studentsCount }}</h4>
                        </div>
                        <div class="icon-circle bg-primary-light">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('students.index') }}" class="text-xs text-primary">عرض التفاصيل <i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-xs font-weight-bold text-success mb-1">عدد المعلمين</h6>
                            <h4 class="mb-0">{{ $teachersCount }}</h4>
                        </div>
                        <div class="icon-circle bg-success-light">
                            <i class="fas fa-chalkboard-teacher text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('teachers.index') }}" class="text-xs text-success">عرض التفاصيل <i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-xs font-weight-bold text-info mb-1">المواد الدراسية</h6>
                            <h4 class="mb-0">{{ $subjectsCount }}</h4>
                        </div>
                        <div class="icon-circle bg-info-light">
                            <i class="fas fa-book text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('subjects.index') }}" class="text-xs text-info">عرض التفاصيل <i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-xs font-weight-bold text-warning mb-1">تقييمات الطلاب</h6>
                            <h4 class="mb-0">{{ $evaluationsCount }}</h4>
                        </div>
                        <div class="icon-circle bg-warning-light">
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('evaluations.index') }}" class="text-xs text-warning">عرض التفاصيل <i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- الأقسام الرئيسية -->
    <div class="row">
        <!-- قسم الطلاب -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-users me-2"></i>إدارة الطلاب
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie mb-4">
                        <canvas id="studentsChart" height="150"></canvas>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary-light text-primary me-2">المجموع: {{ $studentsCount }}</span>
                            <span class="badge bg-success-light text-success me-2">متفوقون: 25%</span>
                        </div>
                        <div>
                            <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> تسجيل طالب
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- قسم المعلمين -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-chalkboard-teacher me-2"></i>إدارة المعلمين
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie mb-4">
                        <canvas id="teachersChart" height="150"></canvas>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-success-light text-success me-2">المجموع: {{ $teachersCount }}</span>
                            <span class="badge bg-info-light text-info me-2">أكفاء: 88%</span>
                        </div>
                        <div>
                            <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus me-1"></i> تعيين معلم
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- الأقسام الثانوية -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-book me-2"></i>المناهج الدراسية
                    </h6>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65% اكتمال المنهج</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-list me-1"></i> عرض المواد
                        </a>
                        <a href="#" class="btn btn-sm btn-info">
                            <i class="fas fa-chart-pie me-1"></i> التقارير
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-star-half-alt me-2"></i>تقييمات الطلاب الحديثة
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            {{-- <div class="flex-shrink-0">
                                <img src="{{ asset('images/teacher-icon.png') }}" width="30" alt="معلم">
                            </div> --}}
                            <div class="flex-grow-1 ms-3">
                                <small>تقييم الطالب أحمد محمد من معلم الرياضيات</small>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">التاريخ: 15/05/2023</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            {{-- <div class="flex-shrink-0">
                                <img src="{{ asset('images/teacher-icon.png') }}" width="30" alt="معلم">
                            </div> --}}
                            <div class="flex-grow-1 ms-3">
                                <small>تقييم الطالبة سارة علي من معلمة اللغة الإنجليزية</small>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">التاريخ: 14/05/2023</small>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('evaluations.index') }}" class="btn btn-sm btn-warning w-100">
                        <i class="fas fa-clipboard-list me-1"></i> عرض جميع التقييمات
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // رسم بياني للطلاب حسب المستوى
    var ctxStudents = document.getElementById('studentsChart').getContext('2d');
    var studentsChart = new Chart(ctxStudents, {
        type: 'doughnut',
        data: {
            labels: ['المستوى الأول', 'المستوى الثاني', 'المستوى الثالث'],
            datasets: [{
                data: [40, 35, 25],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    rtl: true
                }
            },
            cutout: '70%',
        },
    });

    // رسم بياني للمعلمين حسب التخصص
    var ctxTeachers = document.getElementById('teachersChart').getContext('2d');
    var teachersChart = new Chart(ctxTeachers, {
        type: 'doughnut',
        data: {
            labels: ['التخصصات العلمية', 'التخصصات الأدبية', 'التخصصات المهنية'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
                hoverBackgroundColor: ['#17a673', '#2c9faf', '#dda20a'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    rtl: true
                }
            },
            cutout: '70%',
        },
    });
</script>
@endpush

@push('styles')
<style>
    .welcome-card .card {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border-radius: 0.5rem;
    }

    .icon-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
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

    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }

    .progress {
        border-radius: 0.5rem;
    }

    .progress-bar {
        border-radius: 0.5rem;
    }
</style>
@endpush
