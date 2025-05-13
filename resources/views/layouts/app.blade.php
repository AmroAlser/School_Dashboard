<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة المدرسة</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

<!-- Mobile Menu Button -->
<button class="btn btn-primary mobile-menu-btn d-none position-fixed">
    <i class="fas fa-bars me-2"></i> القائمة
</button>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header text-center">
        <h4 class="mb-1 text-white">
            <i class="fas fa-school me-1"></i>
            نظام إدارة المدرسة
        </h4>
        <small class="text-white-50 d-block">
            م. مها الأسطل - مديرة المدرسة
        </small>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{route('dashboard')}}" class="active">
                <i class="fas fa-home"></i>
                الرئيسية
            </a>
        </li>

        <!-- إدارة الطلاب -->
        <li class="dropdown">
            <button onclick="toggleDropdown('studentsDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-users"></i>
                    إدارة الطلاب
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="studentsDropdown" class="dropdown-content">
                <a href="{{route('students.index')}}"><i class="fas fa-list"></i> عرض كافة الطلاب</a>
                <a href="{{ route('students.create') }}"><i class="fas fa-user-plus"></i> تسجيل طالب جديد</a>
                <a href="{{route('students.index')}}"><i class="fas fa-search"></i> بحث عن طالب</a>
                <a href="{{route('reports.allstudents')}}"><i class="fas fa-file-export"></i> تصدير بيانات الطلاب</a>
            </div>
        </li>

        <!-- إدارة المعلمين -->
        <li class="dropdown">
            <button onclick="toggleDropdown('teachersDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-chalkboard-teacher"></i>
                    إدارة المعلمين
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="teachersDropdown" class="dropdown-content">
                <a href="{{route('teachers.index')}}"><i class="fas fa-list"></i> عرض كافة المعلمين</a>
                <a href="{{ route('teachers.create')}}"><i class="fas fa-user-plus"></i> تعيين معلم جديد</a>
            </div>
        </li>

        <!-- إدارة المناهج الدراسية -->
        <li class="dropdown">
            <button onclick="toggleDropdown('academicDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-book-open"></i>
                    المناهج الدراسية
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="academicDropdown" class="dropdown-content">
                <!-- الفصول الدراسية -->
                <a href="{{route('semesters.index')}}"><i class="fas fa-calendar-alt"></i> الفصول الدراسية</a>

                <!-- الصفوف الدراسية -->
                <a href="{{route('classes.index')}}"><i class="fas fa-chalkboard"></i> الصفوف الدراسية</a>

                <!-- المواد الدراسية -->
                <a href="{{route('subjects.index')}}"><i class="fas fa-book"></i> المواد الدراسية</a>

                <!-- الدورات -->
                <a href="{{ route('courses.index') }}"><i class="fas fa-certificate"></i> الدورات</a>
            </div>
        </li>

        <!-- إدارة التقييمات -->
        <li class="dropdown">
            <button onclick="toggleDropdown('evaluationDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-clipboard-check"></i>
                    التقييمات والدرجات
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="evaluationDropdown" class="dropdown-content">
                <!-- التقييمات -->
                <a href="{{ route('evaluations.index') }}"><i class="fas fa-clipboard-list"></i> التقييمات</a>

                <!-- الدرجات -->
                <a href="{{ route('grades.index') }}"><i class="fas fa-star-half-alt"></i> إدارة الدرجات</a>

                <!-- الأوراق والتقارير -->
                <a href="{{ route('papers.index') }}"><i class="fas fa-file-alt"></i> الأوراق والتقارير</a>
            </div>
        </li>

        <!-- التقارير -->
        <li class="dropdown">
            <button onclick="toggleDropdown('reportsDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-chart-bar"></i>
                    التقارير والإحصاءات
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="reportsDropdown" class="dropdown-content">
                <a href="{{ route('reports.students') }}"><i class="fas fa-chart-pie"></i> تقارير الطلاب</a>
                <a href="{{ route('reports.grades') }}"><i class="fas fa-chart-line"></i> تقارير الدرجات</a>
                <a href="{{ route('reports.semesters') }}"><i class="fas fa-chart-bar"></i> إحصاءات الفصول</a>
            </div>
        </li>

        <!-- الإعدادات -->
        <li>
            <a href="{{route('admin.login')}}">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="page-header">
        <h3><i class="@yield('title-icon', 'fas fa-tachometer-alt')"></i> @yield('page-title', 'لوحة التحكم')</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-home"></i> الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'لوحة التحكم')</li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@yield('scripts')
@stack('scripts')
    
</body>
</html>
