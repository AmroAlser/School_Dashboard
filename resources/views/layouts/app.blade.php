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

    <style>
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --secondary-color: #2c3e50;
            --secondary-light: #34495e;
            --accent-color: #e74c3c;
            --accent-light: #f39c12;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --sidebar-width: 280px;
            --border-radius: 8px;
            --transition: all 0.3s ease;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--secondary-color), var(--secondary-light));
            color: white;
            box-shadow: var(--box-shadow);
            z-index: 1000;
            transition: var(--transition);
            overflow-y: auto;
            padding: 0;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h4 {
            font-weight: 700;
            margin: 0;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .sidebar-header h4 i {
            margin-left: 10px;
            color: var(--accent-light);
        }

        .sidebar-header small {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .sidebar-menu {
            padding: 15px 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0 0 5px;
            padding: 0 15px;
        }

        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            transition: var(--transition);
            border-radius: var(--border-radius);
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(-5px);
        }

        .sidebar-menu a i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Dropdown Styles */
        .dropdown {
            margin-bottom: 8px;
        }

        .dropbtn {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 15px;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            border-radius: var(--border-radius);
            width: 100%;
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: var(--transition);
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .dropdown-content {
            display: none;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: var(--box-shadow);
            z-index: 1;
            margin-top: 2px;
            overflow: hidden;
            animation: fadeIn 0.3s ease-out;
        }

        .dropdown-content a {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 15px 10px 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: var(--transition);
            border-right: 3px solid transparent;
            font-size: 0.9rem;
        }

        .dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-right-color: var(--accent-light);
        }

        .dropdown-content a i {
            margin-left: 8px;
            font-size: 0.9rem;
        }

        .show {
            display: block;
        }

        /* Main Content Styles */
        .main-content {
            margin-right: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
            transition: var(--transition);
        }

        .page-header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .page-header h3 {
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
        }

        .page-header h3 i {
            margin-left: 10px;
            color: var(--primary-color);
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header .card-title {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .card-header .card-title i {
            margin-left: 8px;
        }

        /* Button Styles */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-left: 5px;
        }

        /* Table Styles */
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--light-color);
            font-weight: 600;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.85em;
        }

        /* Alert Styles */
        .alert {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
        }

        /* Form Styles */
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 0.5rem 0.75rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                right: -100%;
                width: 85%;
            }

            .sidebar.active {
                right: 0;
            }

            .main-content {
                margin-right: 0;
                padding: 20px;
            }

            .mobile-menu-btn {
                display: block !important;
                position: fixed;
                top: 15px;
                right: 15px;
                padding: 8px 12px;
                z-index: 1100;
                box-shadow: var(--box-shadow);
            }
        }

        /* Additional Styles */
        .rotate-180 {
            transform: rotate(180deg);
            transition: var(--transition);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .action-btns .btn {
            padding: 0.35rem 0.5rem;
            font-size: 0.85rem;
        }

        /* Status Colors */
        .status-active {
            color: var(--success-color);
        }

        .status-inactive {
            color: var(--warning-color);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
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
                <a href="{{route('students.excel')}}"><i class="fas fa-file-export"></i> تصدير بيانات الطلاب</a>
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

        <!-- إدارة الفصول الدراسية -->
        <li class="dropdown">
            <button onclick="toggleDropdown('semestersDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-calendar-alt"></i>
                    الفصول الدراسية
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="semestersDropdown" class="dropdown-content">
                <a href="{{route('semesters.index')}}"><i class="fas fa-list"></i> عرض جميع الفصول</a>
                <a href="{{ route('semesters.create') }}"><i class="fas fa-plus"></i> إضافة فصل جديد</a>
            </div>
        </li>
        <li class="dropdown">
            <button onclick="toggleDropdown('subjectsDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-book"></i>
                    الصفوف الدراسية
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="subjectsDropdown" class="dropdown-content">
                <a href="{{route('classes.index')}}"><i class="fas fa-list"></i> عرض جميع الصفوف</a>
                <a href="{{ route('classes.create') }}"><i class="fas fa-plus"></i> إضافة صف جديدة</a>
            </div>
        </li>

        <!-- إدارة المواد الدراسية -->
        <li class="dropdown">
            <button onclick="toggleDropdown('subjectsDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-book"></i>
                    المواد الدراسية
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="subjectsDropdown" class="dropdown-content">
                <a href="{{route('subjects.index')}}"><i class="fas fa-list"></i> عرض جميع المواد</a>
                <a href="{{ route('subjects.create') }}"><i class="fas fa-plus"></i> إضافة مادة جديدة</a>
            </div>
        </li>

        <!-- إدارة الدرجات -->
        <li class="dropdown">
            <button onclick="toggleDropdown('gradesDropdown')" class="dropbtn">
                <span class="menu-title">
                    <i class="fas fa-clipboard-check"></i>
                    إدارة الدرجات
                </span>
                <i class="fas fa-angle-down arrow"></i>
            </button>
            <div id="gradesDropdown" class="dropdown-content">
                <a href="{{ route('grades.index') }}"><i class="fas fa-list"></i> عرض جميع الدرجات</a>
                <a href="{{ route('grades.create') }}"><i class="fas fa-plus"></i> إضافة درجات جديدة</a>
                <a href="#"><i class="fas fa-file-import"></i> استيراد الدرجات</a>
            </div>
        </li>

        <!-- التقييمات -->
        <li>
            <a href="{{ route('evaluations.index') }}">
                <i class="fas fa-clipboard-check"></i>
                التقييمات
            </a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Toggle dropdown function
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle("show");

        // Rotate arrow icon
        const btn = document.querySelector(`button[onclick="toggleDropdown('${id}')"]`);
        const arrow = btn.querySelector('.arrow');
        arrow.classList.toggle('rotate-180');
    }

    // Close dropdowns when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn') && !event.target.closest('.dropbtn')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                if (dropdowns[i].classList.contains('show')) {
                    dropdowns[i].classList.remove("show");

                    // Reset arrow icon
                    const arrow = dropdowns[i].previousElementSibling.querySelector('.arrow');
                    if (arrow) {
                        arrow.classList.remove('rotate-180');
                    }
                }
            }
        }
    }

    // Mobile menu toggle
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Show mobile menu button on small screens
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            document.querySelector('.mobile-menu-btn').classList.remove('d-none');
        } else {
            document.querySelector('.mobile-menu-btn').classList.add('d-none');
            document.querySelector('.sidebar').classList.remove('active');
        }
    }

    // Run on load and resize
    window.addEventListener('load', checkScreenSize);
    window.addEventListener('resize', checkScreenSize);

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@yield('scripts')
</body>
</html>
