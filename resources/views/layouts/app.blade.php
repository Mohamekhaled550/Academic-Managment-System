<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>

    <!-- إضافة ملفات CSS مثل Bootstrap أو أي ملف مخصص -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Navbar أو أي عناصر أخرى للموقع -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">نظام التسجيل</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="التبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('student.dashboard') }}">الصفحة الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.status') }}">حالة الطالب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.courses') }}">تسجيل المقررات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.profile') }}">بيانات الطالب</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- المحتوى الرئيسي -->
        <div class="mt-4">
            @yield('content')
        </div>
    </div>

    <!-- إضافة ملفات JavaScript مثل Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
