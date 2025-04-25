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
        }

        .page-header h3 {
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
            font-size: 1.8rem;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-top: 10px;
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
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            padding: 1rem 1.5rem;
        }

        /* Button Styles */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: var(--transition);
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

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .alert {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table th {
            background-color: var(--light-color);
            font-weight: 600;
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
                <a href="{{route('students.export.excel')}}"><i class="fas fa-file-export"></i> تصدير بيانات الطلاب</a>
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

        <li>
            <a href="{{route('subjects.index')}}">
                <i class="fas fa-book"></i>
                المواد الدراسية
            </a>
        </li>

        <li>
            <a href="{{ route('evaluations.index') }}">
                <i class="fas fa-clipboard-check"></i>
                التقييمات
            </a>
        </li>

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
        <h3>@yield('page-title', 'لوحة التحكم')</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'لوحة التحكم')</li>
            </ol>
        </nav>
    </div>

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
</script>

</body>
</html>
