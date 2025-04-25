<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة المدرسة - تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
        }

        body {
            background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
            font-family: 'Tajawal', sans-serif;
            height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .login-body {
            padding: 2rem;
            background-color: white;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d3e2;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-color);
        }

        .form-floating {
            position: relative;
        }

        .form-floating label {
            right: auto;
            left: 3rem;
        }

        .form-floating > .form-control {
            padding-right: 3rem;
        }

        .alert {
            border-radius: 0.5rem;
        }

        .school-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }

        .forgot-password {
            color: var(--dark-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="login-card">
        <div class="login-header">
            <img src="{{asset("images/image.png")}}" alt="شعار المدرسة" class="school-logo rounded-circle bg-white p-2">
            <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>نظام إدارة المدرسة</h4>
            <p class="mb-0 mt-2">تسجيل دخول المشرفين</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-4 form-floating">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" class="form-control ps-5"
                           placeholder="البريد الإلكتروني" required autofocus>
                    <label for="email">البريد الإلكتروني</label>
                </div>

                <div class="mb-4 form-floating">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-control ps-5"
                           placeholder="كلمة المرور" required>
                    <label for="password">كلمة المرور</label>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">تذكرني</label>
                    <a href="#" class="forgot-password float-start">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="btn btn-primary btn-login w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                </button>

                <div class="text-center mt-4">
                    <p class="mb-0">جميع الحقوق محفوظة &copy; م.عمرو السر {{ date('Y') }}</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // إضافة تأثيرات بسيطة عند التركيز على الحقول
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#4e73df';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#5a5c69';
            });
        });
    </script>
</body>
</html>
